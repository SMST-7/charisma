<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function store(Request $request)
    {
        // ذخیره محصول
        $product = Product::create([
            'name' => $request->title,
            'description' => $request->description,
            'price' => $request->price,

            'image_description' => $request->image_description,
            'stock' => $request->stock,
            'cat_id' => $request->cat_id,
            'slug'=>$request->slug,
        ]);

        // بررسی وجود عکس
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                // ذخیره در پوشه public/products
                $path = $image->store('pictures', 'public');

                // ساخت رکورد در جدول product_images
                $product->images()->create([
                    'image_path' => $path,
                    'is_main' => $index === 0, // اولین عکس رو اصلی بزار
                ]);
            }
        }

        return redirect()->back()->with('success', 'محصول با موفقیت ذخیره شد.');
    }
}
