<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function index(Request $request)
    {
        // شروع کوئری محصولات
        $products = Product::with([
            'images',
            'category',
            'discounts' => function ($query) {
                $query->isActive()->betweenStartandEndDate();
            }
        ])->withAvg('reviews', 'rating');

        // ✅ مرتب‌سازی
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $products->orderBy('name', 'asc');
                    break;

                case 'name_desc':
                    $products->orderBy('name', 'desc');
                    break;

                case 'price_asc':
                    $products->orderBy('price', 'asc');
                    break;

                case 'price_desc':
                    $products->orderBy('price', 'desc');
                    break;
            }
        }

    // ✅ فقط سرچ روی نام محصول
    if ($request->filled('search')) {
        $products->where('name', 'LIKE', '%' . $request->search . '%');
    }

    $products = $products->get();

    // ✅ پاسخ Ajax
    if ($request->ajax()) {
        return view('app.partials.products', compact('products'))->render();
    }


        // ✅ این فقط برای لود اولیه صفحه است
        $categories = Category::with('products')->get();

        return view('app.product.index', compact('products', 'categories'));
    }


    public function show($slug)
    {
        $product = Product::with([
            'images',
            'category',
            'attributeValues.attribute',
            'discounts' => function ($query) {
                $query->isActive()->betweenStartandEndDate();
            },
            'reviews'
        ])
            ->withCount('reviews as reviews_count')
            ->withAvg('reviews as reviews_avg_rating', 'rating')
            ->where('slug', $slug)
            ->firstOrFail();

        // بررسی اینکه آیا محصول در علاقه‌مندی‌های کاربر هست یا نه
        $isInWishlist = false;
        if(auth()->check()){
            $isInWishlist = auth()->user()->wishlists->contains('product_id', $product->id);
        }

        // همه محصولات برای پیشنهادات
        $products = Product::with(['images', 'category'])
            ->withCount('reviews as reviews_count')
            ->withAvg('reviews as reviews_avg_rating', 'rating')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        $attribute_values = AttributeValue::with('attribute')->get();

        return view('app.product.singleProduct', compact(
            'product',
            'products',
            'attribute_values',
            'isInWishlist' // حتماً این متغیر را به ویو پاس بده
        ));
    }


}
