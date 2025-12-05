<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use Sluggable;

    protected $fillable=['name',
        'description',
        'price',
        'image_description',
        'stock',
        'cat_id',
        'slug',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id');

    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_values', 'product_id', 'attribute_value_id')
            ->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_main', 1);
    }

    public function activeDiscount()
    {
        return $this->discounts()
            ->where('is_active', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();
    }

    public function finalPrice()
    {
        $discount = $this->activeDiscount();

        if ($discount) {
            return floor($this->price - ($this->price * $discount->discount_percentage / 100));
        }

        return $this->price;
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }


    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function discount()
    {
        return $this->hasMany(Discount::class);
    }

// گرفتن اولین تخفیف فعال و معتبر
    public function getActiveDiscountAttribute()
    {
        return $this->discounts()
            ->isActive()
            ->betweenStartAndEndDate()
            ->first();
    }

// قیمت بعد از تخفیف
    public function getDiscountedPriceAttribute()
    {
        return $this->active_discount ? $this->active_discount->getDiscountedPrice() : $this->price;
    }

// درصد تخفیف فعال
    public function getDiscountPercentageAttribute()
    {
        return $this->active_discount ? $this->active_discount->discount_percentage : 0;
    }
    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeBetweenStartAndEndDate($query)
    {
        return $query->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id')
            ->where('status', 'approved'); // فقط نظرات تایید شده
    }

    public function reviews_avg_rating()
    {
        return $this->reviews()->avg('rating');
    }
    public function sluggable(): array
    {

        return [
            'slug' => [
                'source' => 'name',
                'method' => function(string $string, string $separator) {
                    $slug = trim($string);
                    $slug = preg_replace('/[^\p{Arabic}\p{L}\p{N}\s]+/u', '', $slug);
                    $slug = preg_replace('/[\s]+/u', $separator, $slug);
                    return mb_strtolower($slug, 'UTF-8');
                },
                'separator' => '-',
                'unique' => true,
                'includeTrashed' => false,
                'onUpdate' => true,
                'maxLength' => 100 // محدودیت طول slug
            ]
        ];
    }
}
