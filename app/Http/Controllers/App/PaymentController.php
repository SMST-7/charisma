<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Zarinpal\Zarinpal;

class PaymentController extends Controller
{
    public function start(Request $request)
    {
        $user = Auth::user();

        // بررسی آدرس
        if (!$request->address_id) {
            return back()->with('error', 'لطفا یک آدرس را انتخاب کنید.');
        }

        $cart = Cart::where('user_id', $user->id)->with(['items.product'])->first();

        if (!$cart || $cart->items->count() == 0) {
            return back()->with('error', 'سبد خرید شما خالی است.');
        }

        // هزینه ارسال
        $shipping = Shipping::where('active', 1)->first();

        // محاسبه مبلغ کل
        $cartTotal = $cart->items->sum(fn($item) => $item->quantity * $item->product->price);

        // تخفیف
        $discount = 0;
        if ($cart->coupon) {
            $discount = $cart->coupon->type == 'percent'
                ? ($cartTotal * $cart->coupon->amount) / 100
                : min($cart->coupon->amount, $cartTotal);
        }

        $finalAmount = $cartTotal - $discount + ($shipping->cost ?? 0);

        // ساخت سفارش در حالت "در انتظار پرداخت"
        $order = Order::create([
            'user_id'       => $user->id,
            'address_id'    => $request->address_id,
            'shipping_id'   => $shipping?->id,
            'shipping_cost' => $shipping?->cost ?? 0,
            'total_price'   => $finalAmount,
            'status'        => 'pending',
        ]);

        // ذخیره آیتم‌های سفارش
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
                'total'      => $item->quantity * $item->product->price,
            ]);
        }

        // اتصال به زرین پال
        $zarinpal = new Zarinpal(env('ZARINPAL_MERCHANT_ID'));

        $result = $zarinpal->request(
            route('payment.zarinpal.callback'),
            $finalAmount * 10, // تبدیل تومان به ریال
            "پرداخت سفارش شماره {$order->id}",
            $user->email ?? "",
            $user->phone ?? "",
            []
        );

        if (isset($result['Authority']) && $result['Status'] == 100) {
            // پاک کردن سبد خرید
            $cart->items()->delete();

            return redirect('https://www.zarinpal.com/pg/StartPay/' . $result['Authority']);
        }

        return back()->with('error', 'خطا در اتصال به درگاه پرداخت.');
    }


    public function callback(Request $request)
    {
        $authority = $request->Authority;

        $zarinpal = new Zarinpal(env('ZARINPAL_MERCHANT_ID'));

        $result = $zarinpal->verify($authority);

        if ($result['Status'] == 100) {

            // پیدا کردن سفارش
            $order = Order::where('status', 'pending')->latest()->first();

            $order->update([
                'status' => 'paid',
                'ref_id' => $result['RefID'], // کد پیگیری
            ]);

            return redirect()->route('panel.orders.index')->with('success', 'پرداخت با موفقیت انجام شد.');
        }

        return redirect()->route('panel.orders.index')->with('error', 'پرداخت ناموفق بود.');
    }
}
