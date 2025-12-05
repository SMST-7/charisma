<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable=[
        'cart_id',
//        'attributes',
        'product_id',
        'quantity',
        'attributes',
    ];


    protected $casts = [
        'attributes' => 'array', // اطمینان از cast به آرایه
    ];
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

//    public function attributeValues()
//    {
//        return $this->hasMany(AttributeValue::class);
//    }
}
