<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'parent_id',
        'rating',
        'comment',
        'status',
    ];

    // ارتباط با یوزر
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ارتباط با محصول
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
