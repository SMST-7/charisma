<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)
            ->with(['items.product.discounts', 'coupon'])
            ->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'سبد خرید شما خالی است.');
        }

        $addresses = Address::where('user_id', $user->id)->get();
        $shipping  = Shipping::where('active', 1)->first();

        // =============================
        //   قیمت محصولات بعد از تخفیف
        // =============================
        $total = 0;
        foreach ($cart->items as $item) {
            $finalPrice = $item->product->finalPrice();
            $total += $finalPrice * $item->quantity;
        }

        // =============================
        //   تخفیف کوپن
        // =============================
        $discount = 0;
        $coupon = $cart->coupon;

        if ($coupon && $coupon->active) {
            if ($coupon->type === 'percent') {
                $discount = ($total * $coupon->value) / 100;
            } else {
                $discount = min($coupon->value, $total);
            }
        }

        $percentage = $total > 0 ? round(($discount / $total) * 100, 2) : 0;
        $shippingCost = $shipping?->cost ?? 0;

        $finalTotal = $total + $shippingCost - $discount;

        return view('app.order', compact(
            'cart', 'addresses', 'shipping', 'discount', 'percentage', 'finalTotal', 'coupon', 'total'
        ));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'address_id' => 'required|exists:addresses,id'
        ]);

        $cart = Cart::where('user_id', $user->id)
            ->with(['items.product'])
            ->first();

        if (!$cart || $cart->items->count() === 0) {
            return back()->with('error', 'سبد خرید خالی است.');
        }

        $shipping = Shipping::where('active', 1)->first();

        // =============================
        //    مجموع نهایی برای ثبت سفارش
        // =============================
        $total = 0;
        foreach ($cart->items as $item) {
            $total += $item->product->finalPrice() * $item->quantity;
        }

        $discount = 0;
        if ($cart->coupon) {
            if ($cart->coupon->type == 'percent') {
                $discount = ($total * $cart->coupon->value) / 100;
            } else {
                $discount = min($cart->coupon->value, $total);
            }
        }

        $finalTotal = $total + ($shipping->cost ?? 0) - $discount;

        // =============================
        //    ساخت سفارش
        // =============================
        $order = Order::create([
            'user_id'       => $user->id,
            'address_id'    => $request->address_id,
            'shipping_id'   => $shipping?->id,
            'shipping_cost' => $shipping->cost ?? 0,
            'total_price'   => $finalTotal,
            'status'        => 'pending',
        ]);

        // =============================
        //   ایجاد آیتم‌های سفارش
        // =============================
        foreach ($cart->items as $item) {
            $finalProductPrice = $item->product->finalPrice();

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $finalProductPrice,
                'total'      => $finalProductPrice * $item->quantity,
            ]);
        }

        // پاک کردن آیتم‌های سبد خرید
        $cart->items()->delete();

        return redirect()->route('panel.orders.index')->with('success', 'سفارش شما با موفقیت ثبت شد.');
    }
}
