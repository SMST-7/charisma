<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable=
    [
        'code',
        'type',
        'value',
        'min_order_amount',
        'usage_limit',
        'start_date',
        'end_date',
        'active'
    ];

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

}
