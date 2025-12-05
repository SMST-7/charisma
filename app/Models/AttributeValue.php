<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = ['attribute_id', 'value']; // فیلدهایی که می‌توانند به صورت جمعی پر شوند

    /**
     * رابطه معکوس (belongsTo) با Attribute
     * هر AttributeValue متعلق به یک Attribute است
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    /**
     * رابطه چند به چند با Product
     * هر مقدار ویژگی می‌تواند به چندین محصول مرتبط باشد
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute_values', 'attribute_value_id', 'product_id')
            ->withTimestamps();
    }

    public function CartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
