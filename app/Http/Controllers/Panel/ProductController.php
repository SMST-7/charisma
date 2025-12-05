<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use function view;

class ProductController extends Controller
{

    public function index()
    {
        // 10 محصول در هر صفحه + eager load دسته‌بندی
        $products = Product::with('category', 'images', 'attributeValues.attribute')->orderBy('created_at', 'desc')->paginate(10);
//        $coupons=Coupon::where('active',1)->get();

        return view('panel.product.index', compact('products'));
    }



    public function create()
    {
        $categories=Category::all();
        $attribute_values=AttributeValue::with('attribute')->get();

        return view('panel.product.create',compact('categories','attribute_values'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'price' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_description' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer',
            'cat_id' => 'required|exists:categories,id',
            'attribute_value' => 'nullable|array',
            'attribute_value.*' => 'exists:attribute_values,id',
        ]);

        $data = $validated;


        $destinationPath = public_path('panel/pictures/');

        // ذخیره تصویر توضیحات (image_description)
        if ($request->hasFile('image_description')) {
            $fileName = time() . '_' . $request->file('image_description')->getClientOriginalName();
            $request->file('image_description')->move($destinationPath, $fileName);
            $data['image_description'] = $fileName;
        }


        // ایجاد محصول
        $product = Product::create($data);

        // ذخیره تصاویر محصول

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $product->images()->create([
                    'image_path' => 'panel/pictures/' . $fileName,
                    'is_main' => $index === 0, // اولین تصویر به‌عنوان تصویر اصلی
                ]);
            }
        }
        // ثبت لاگ برای ایجاد لیست
        ActivityLog::record('ایجاد', 'لیست محصولات', $product->id, 'Created a new product titled: ' .  $product->title);

        // افزودن مقادیر ویژگی‌ها به جدول واسط
        $product->attributeValues()->attach($validated['attribute_value']);

        return redirect()->route('product.index')->with('insert', 'محصول با موفقیت اضافه شد');
    }


    public function show(string $id)
    {
        //
    }

    public function edit($slug)
    {
        $product = Product::with(['images', 'attributeValues.attribute'])
            ->where('slug', $slug)
            ->firstOrFail();
        $categories=Category::all();
        $attribute_values=AttributeValue::with('attribute')->get();
        return view('panel.product.edit',compact('product','categories','attribute_values'));

    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|string',
            'stock' => 'required|integer',
            'cat_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // درست: name="image"
            'attribute_value.*' => 'exists:attribute_values,id',
        ]);

        $data = $request->only(['name', 'description', 'price', 'stock', 'cat_id']);

        $destinationPath = public_path('panel/pictures/');

        // 1. مدیریت تصویر توضیحات (فیلد name="image")
        if ($request->hasFile('image')) {
            // حذف تصویر قبلی اگر وجود داشت
            if ($product->image_description && File::exists($destinationPath . $product->image_description)) {
                File::delete($destinationPath . $product->image_description);
            }

            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $fileName);
            $data['image_description'] = $fileName;

        } elseif ($request->has('remove_image') && $request->remove_image == 1) {
            // کاربر خواسته تصویر قبلی حذف بشه
            if ($product->image_description && File::exists($destinationPath . $product->image_description)) {
                File::delete($destinationPath . $product->image_description);
            }
            $data['image_description'] = null;
        }
        // اگر هیچ‌کدوم نبود → تصویر قبلی حفظ میشه (هیچ تغییری در $data اعمال نمیشه)

        // 2. مدیریت تصاویر گالری
        if ($request->filled('remove_images')) {
            foreach ($product->images as $image) {
                if (File::exists(public_path($image->image_path))) {
                    File::delete(public_path($image->image_path));
                }
            }
            $product->images()->delete();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $product->images()->create([
                    'image_path' => 'panel/pictures/' . $fileName,
                    'is_main' => $product->images()->count() === 0 && $index === 0,
                ]);
            }
        }

        // 3. به‌روزرسانی محصول
        $product->update($data);

        // ثبت لاگ برای ویرایش لیست
        ActivityLog::record('ویرایش', 'لیست محصولات', $product->id, 'Updated  product titled: ' .  $product->title);


        // 4. ویژگی‌ها
        if ($request->has('attribute_value')) {
            $product->attributeValues()->sync($request->attribute_value);
        } else {
            $product->attributeValues()->detach(); // اگر هیچی انتخاب نشده بود
        }



        return redirect()->route('product.index')->with('success', 'محصول با موفقیت به‌روزرسانی شد');
    }



    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $destinationPath = public_path('panel/pictures/');

        // حذف تصویر توضیحات (image_description)
        if ($product->image_description && File::exists($destinationPath . $product->image_description)) {
            File::delete($destinationPath . $product->image_description);
        }

        // حذف تصاویر محصول از جدول product_images و پوشه
        foreach ($product->images as $image) {
            if (File::exists(public_path($image->image_path))) {
                File::delete(public_path($image->image_path));
            }
        }
        $product->images()->delete(); // حذف رکوردهای تصاویر از دیتابیس

        // حذف محصول
        $product->delete();

        // ثبت لاگ برای حذف لیست
        ActivityLog::record('حذف', 'لیست محصولات', $product->id, 'Deleted  product titled: ' .  $product->title);

        return redirect()->route('product.index')->with('delete', 'محصول با موفقیت حذف شد');
    }
}
