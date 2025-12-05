<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;
    use Sluggable;

    protected $fillable = ['title', 'parent_id', 'image', 'slug', 'is_active'];

    // رابطه خود-ارجاعی برای دسته‌بندی والد
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    // رابطه برای دسته‌بندی‌های فرزند (اختیاری، در صورت نیاز)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id');
    }
     public function sluggable(): array
     {
         return [
             'slug' => [
                 'source' => 'title',
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
