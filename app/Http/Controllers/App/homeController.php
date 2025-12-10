<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class homeController extends Controller
{


    public function index()
    {
        // محصولات تخفیف‌دار فعال
        $discountedProducts = Product::with(['images', 'mainImage', 'category', 'discounts'])
            ->withCount(['reviews as reviews_count'])
            ->withAvg('reviews as reviews_avg_rating', 'rating')
            ->whereHas('discounts', function($q) {
                $q->isActive()->betweenStartAndEndDate();
            })
            ->latest()
            ->take(8)
            ->get();

        // محصولات جدید
        $newProducts = Product::with(['images', 'mainImage', 'category'])
            ->withCount(['reviews as reviews_count'])
            ->withAvg('reviews as reviews_avg_rating', 'rating')
            ->latest()
            ->take(8)
            ->get();

        // مقالات سایت (آخرین مقالات)
        $blogs = Blog::latest()->paginate(6); // می‌تونی تعداد را تغییر بدی

        // بنرها و سرویس‌ها
        $banners = Banner::all();
        $services = Service::all();

        // دسته‌بندی‌های فعال
        $categories = Category::where('is_active', 1)->get();

        return view('app.home', compact(
            'discountedProducts',
            'newProducts',
            'blogs',
            'banners',
            'services',
            'categories'
        ));
    }


    public function getProducts(Request $request)
    {
        $slug = $request->query('category');

        if ($slug === 'all') {
            $products = Product::with(['images', 'category'])
                ->withAvg('reviews', 'rating')
                ->latest()
                ->take(8)
                ->get();
        } else {
            $category = Category::where('slug', $slug)->firstOrFail();
            $products = Product::with(['images', 'category'])
                ->withAvg('reviews', 'rating')
                ->where('cat_id', $category->id)
                ->latest()
                ->take(8)
                ->get();
        }

        return view('app.partials.new-products', ['newProducts' => $products])->render();
    }



    public function show($slug)
    {
        $category = Category::with('products')->where('slug', $slug)
            ->where('is_active', 1)->firstOrFail();

        $categories = Category::with('parent')
            ->where('is_active', 1)
            ->where('slug', '!=', $slug)
            ->get();

        $products = Product::with(['category','images'])
            ->withAvg('reviews', 'rating') // اینجا میانگین ستاره‌ها رو میاره
            ->where('cat_id', $category->id)
            ->get();

        $attribute_values = AttributeValue::with('attribute')->get();

        return view('app.singleCategory', compact('category','categories','products','attribute_values'));
    }


}
