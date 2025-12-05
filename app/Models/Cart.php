<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable=
    [
        'user_id',
        'guest_token',
        'coupon_code',
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_code', 'code');
    }



    /**
     * محاسبه مجموع قیمت آیتم‌های سبد خرید (بدون تخفیف)
     */
    public function getTotalprice()
    {
        return $this->items->sum(function($item){
            return $item->quantity * $item->product->price;
        });
    }

    /**
     * محاسبه مقدار تخفیف بر اساس کوپن
     */
//    public function getDiscount()
//    {
//        if (!$this->coupon || !$this->coupon->active) {
//            return 0;
//        }
//
//        $total = $this->getTotalPrice();
//        if ($this->coupon->type === 'percent') {
//            return ($total * $this->coupon->amount) / 100;
//        }
//
//        return min($this->coupon->amount, $total); // برای تخفیف ثابت، حداکثر تا مجموع سبد
//    }

    /**
     * محاسبه مبلغ نهایی (با احتساب هزینه حمل و تخفیف)
     */
//    public function getFinalTotal($shippingCost = 985000)
//    {
//        $total = $this->getTotalPrice();
//        $discount = $this->getDiscount();
//        return $total - $discount + $shippingCost;
//    }

}
