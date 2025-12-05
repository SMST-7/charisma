<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;

use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    public function index()
    {
        $cart = null;

        // دریافت سبد خرید کاربر یا مهمان
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())
                ->with(['items.product.images', 'coupon'])
                ->first();
        } elseif (session('guest_token')) {
            $cart = Cart::where('guest_token', session('guest_token'))
                ->with(['items.product.images', 'coupon'])
                ->first();
            if (!$cart) session()->forget('guest_token');
        }

        // آماده‌سازی ویژگی‌ها برای هر آیتم
        if ($cart && $cart->items) {
            foreach ($cart->items as $item) {
                $item->selected_attributes = collect($item->attributes ?? [])->map(function ($valueId, $attrId) {
                    $attribute = \App\Models\Attribute::find($attrId);
                    $value = \App\Models\AttributeValue::find($valueId);
                    return [
                        'attribute_name' => $attribute ? $attribute->name : 'نامشخص',
                        'value' => $value ? $value->value : 'نامشخص',
                    ];
                })->values();
            }
        }



        $total = 0;
        foreach ($cart->items as $item) {
            $finalPrice = $item->product->finalPrice();
            $total += $finalPrice * $item->quantity;
        }



        $shipping  = Shipping::where('active', 1)->first();


        // تخفیف
        $discount = 0;
        $coupon = $cart->coupon ?? null;

        if ($coupon && $coupon->active) {
            if ($coupon->type === 'percent') {
                $discount = ($total * $coupon->value) / 100;
            } else {
                $discount = min($coupon->value, $total);
            }
        }

// درصد تخفیف
        $percentage = $total > 0 ? round(($discount / $total) * 100, 2) : 0;

        $shippingCost = $shipping?->cost ?? 0;
// مبلغ نهایی
        $finalTotal = $total + $shippingCost - $discount;
// پاس دادن داده‌ها به ویو
        return view('app.cart.index', compact('cart', 'total', 'shipping', 'discount', 'percentage', 'finalTotal', 'coupon'));

    }


    public function addToCart(Request $request)
    {
        // اعتبارسنجی ورودی‌ها
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'attribute_*' => 'required|exists:attribute_values,id',
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $product = Product::where('id', $productId)->with(['images', 'attributeValues.attribute'])->firstOrFail();


        // استخراج ویژگی‌ها
        $attributes = $request->input('attributes', []);


        // اگر هیچ ویژگی انتخاب نشده، attributes را null یا آرایه خالی تنظیم کنید
        $attributes = empty($attributes) ? null : $attributes;


        // بررسی وجود سبد خرید
        if (Auth::check()) {
            // برای کاربران واردشده
            $cart = Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                ['user_id' => Auth::id(), 'guest_token' => null]
            );
        } else {
            // برای کاربران مهمان
            $guestToken = session('guest_token', \Str::random(32));
            session(['guest_token' => $guestToken]);
            $cart = Cart::firstOrCreate(
                ['guest_token' => $guestToken],
                ['guest_token' => $guestToken]
            );
        }




        $cartItem = $cart->items()->where('product_id', $productId)
            ->where('attributes', json_encode($attributes))
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'attributes' => $attributes,
            ]);
        }


        return redirect()->route('cart.index')->with('success', 'محصول به سبد خرید اضافه شد.');
    }


    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($itemId);

        // بررسی دسترسی کاربر

        $cart = Auth::check()
            ? Cart::where('user_id', Auth::id())->firstOrFail()
            : Cart::where('guest_token', session('guest_token'))->firstOrFail();


        if ($cartItem->cart_id !== $cart->id) {
            return redirect()->route('cart.index')->with('error', 'دسترسی به این آیتم مجاز نیست.');
        }

        // به‌روزرسانی تعداد
        $cartItem->update([
            'quantity' => $request->input('quantity'),
        ]);


        return redirect()->route('cart.index')->with('success', 'تعداد محصول به‌روزرسانی شد.');
    }


    public function updateAttributes(Request $request, $itemId)
    {
        $request->validate([
            'attribute_*' => 'nullable|exists:attribute_values,id',
        ]);

        $cartItem = CartItem::findOrFail($itemId);

        // بررسی دسترسی کاربر به آیتم سبد خرید
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->firstOrFail();
        } else {
            $cart = Cart::where('guest_token', session('guest_token'))->firstOrFail();
        }

        if ($cartItem->cart_id !== $cart->id) {
            return redirect()->route('cart.index')->with('error', 'دسترسی به این آیتم مجاز نیست.');
        }

        // استخراج ویژگی‌های جدید
        $attributes = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'attribute_') === 0 && $value) {
                $attributeId = str_replace('attribute_', '', $key);
                $attributes[$attributeId] = $value;
            }
        }

        $attributes = empty($attributes) ? null : $attributes;


        // به‌روزرسانی ویژگی‌ها
        $cartItem->update([
            'attributes' => $attributes,
        ]);

        return redirect()->route('cart.index')->with('success', 'ویژگی‌های محصول به‌روزرسانی شد.');
    }

    public function removeFromCart($itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);

        $cart = Auth::check()
            ? Cart::where('user_id', Auth::id())->firstOrFail()
            : Cart::where('guest_token', session('guest_token'))->firstOrFail();


        // اطمینان از اینکه آیتم متعلق به سبد خرید کاربر است
        if ($cartItem->cart_id === $cart->id) {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'آیتم از سبد خرید حذف شد.');
        }

        return redirect()->route('cart.index')->with('error', 'خطا در حذف آیتم.');
    }


    public function mergeGuestCart()
    {
        if (Auth::check() && session('guest_token')) {
            $guestCart = Cart::where('guest_token', session('guest_token'))->first();
            if ($guestCart) {
                $userCart = Cart::firstOrCreate(['user_id' => Auth::id()]);
                foreach ($guestCart->items as $item) {
                    $userCart->items()->updateOrCreate(
                        ['product_id' => $item->product_id],
                        ['quantity' => $item->quantity, 'price' => $item->price]
                    );
                }
                $guestCart->delete();
                session()->forget('guest_token');
                session()->flash('success', 'سبد خرید مهمان با موفقیت ادغام شد.');
            } else {
                session()->flash('error', 'هیچ سبد خرید مهمانی یافت نشد.');
            }
        }



    }

    public function verifyCouponCode(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ], [
            'coupon_code.required' => 'لطفاً کد تخفیف را وارد کنید.',
        ]);

        // سبد خرید
        $cart = Auth::check()
            ? Cart::where('user_id', Auth::id())->firstOrFail()
            : Cart::where('guest_token', session('guest_token'))->firstOrFail();

        $couponCode = $request->coupon_code;

        // پیدا کردن کوپن
        $coupon = Coupon::where('code', $couponCode)->first();

        // -------------------------
        //   شروع ارورهای دقیق
        // -------------------------

        if (!$coupon) {
            return redirect()->back()->with('error', 'کد تخفیف وارد شده وجود ندارد.');
        }

        if ($coupon->active == 0) {
            return redirect()->back()->with('error', 'این کد تخفیف غیرفعال است.');
        }

        // تاریخ شروع
        if ($coupon->start_date && now()->lt($coupon->start_date)) {
            return redirect()->back()->with('error', 'این کد تخفیف هنوز فعال نشده است.');
        }

        // تاریخ انقضا
        if ($coupon->expire_date && now()->gt($coupon->expire_date)) {
            return redirect()->back()->with('error', 'این کد تخفیف منقضی شده است.');
        }

        // حداقل مبلغ خرید
        if ($coupon->min_purchase_amount && $cart->total_price < $coupon->min_purchase_amount) {
            return redirect()->back()->with(
                'error',
                'حداقل مبلغ خرید برای استفاده از این کد تخفیف ' . number_format($coupon->min_purchase_amount) . ' تومان است.'
            );
        }

        // چک کردن استفاده قبلی (اگر ستون دارید)
        if ($coupon->max_uses && $coupon->used_count >= $coupon->max_uses) {
            return redirect()->back()->with('error', 'ظرفیت استفاده از این کد تخفیف تکمیل شده است.');
        }

        // -------------------------
        //   ذخیره‌سازی کوپن روی سبد
        // -------------------------

        $cart->coupon_code = $coupon->code;
        $cart->save();

        return redirect()->back()->with('success', 'کد تخفیف با موفقیت اعمال شد.');
    }



}

