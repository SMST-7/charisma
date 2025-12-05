<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Foundation\Exceptions\Renderer\Exception;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function index()
    {
        $discounts = Discount::with('product')
            ->get();
        return view('panel.discount.index', compact('discounts'));
    }


    public function create()
    {
        $products=Product::all();
        return view('panel.discount.create',compact('products'));
    }




    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'is_active' => 'required|in:0,1',
            'start_date' => 'required|date_format:Y/m/d H:i:s',
            'end_date' => 'required|date_format:Y/m/d H:i:s|after:start_date',
        ]);



        try {
            $validated['start_date'] = \Morilog\Jalali\Jalalian::fromFormat('Y/m/d H:i:s', $validated['start_date'])->toCarbon();
            $validated['end_date'] = \Morilog\Jalali\Jalalian::fromFormat('Y/m/d H:i:s', $validated['end_date'])->toCarbon();
        } catch (Exception $e) {
            return back()->withErrors(['start_date' => 'فرمت تاریخ یا زمان نامعتبر است.'])->withInput();
        }

        $discount=Discount::create($validated);

        ActivityLog::record('ایجاد', 'تخفیف', $discount->id, 'Created a new discount titled: ' . $discount->title);

        return redirect()->route('discount.index')->with('success', 'تخفیف با موفقیت ایجاد شد.');
    }


    public function showDiscountedProducts(Request $request)
    {
        // فقط محصولات تخفیف‌دار فعال و در بازه زمانی
        $products = Product::with([
            'images',
            'category',
            'discounts' => fn($q) => $q->isActive()->betweenStartAndEndDate()
        ])
            ->withAvg('reviews', 'rating')
            ->whereHas('discounts', fn($q) => $q->isActive()->betweenStartAndEndDate());


        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'name_asc':  $products->orderBy('name', 'asc'); break;
                case 'name_desc': $products->orderBy('name', 'desc'); break;
                case 'price_asc': $products->orderBy('price', 'asc'); break;
                case 'price_desc':$products->orderBy('price', 'desc'); break;
            }
        }

        // فیلتر دسته‌بندی
        if ($request->filled('cat_slug')) {
            $category = Category::where('slug', $request->cat_slug)->first();
            if ($category) {
                $products->where('cat_id', $category->id);
            } else {
                $products->whereNull('cat_id'); // هیچ محصولی
            }
        }

        // جستجو
        if ($request->filled('search')) {
            $products->where('name', 'like', "%{$request->search}%");
        }


        $products = $products->get();


        // پاسخ Ajax
        if ($request->ajax()) {
            return view('app.partials.discountedProduct', compact('products'))->render();
        }
        // فقط محصولات تخفیف‌دار رو برگردون
        return view('app.discountedProduct.index', compact('products'));
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $discount=Discount::findorFail($id);
        $products=Product::all();
        return view('panel.discount.edit',compact('discount','products'));
    }


    public function update(Request $request, string $id)
    {
        $discount=Discount::findorFail($id);

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date_format:Y/m/d H:i:s',
            'end_date' => 'required|date_format:Y/m/d H:i:s|after:start_date',
        ]);

        try {
            $validated['start_date'] = \Morilog\Jalali\Jalalian::fromFormat('Y/m/d H:i:s', $validated['start_date'])->toCarbon();
            $validated['end_date'] = \Morilog\Jalali\Jalalian::fromFormat('Y/m/d H:i:s', $validated['end_date'])->toCarbon();
        } catch (Exception $e) {
            return back()->withErrors(['start_date' => 'فرمت تاریخ یا زمان نامعتبر است.'])->withInput();
        }

        $discount->update($validated);

        ActivityLog::record('ویرایش', 'تخفیف', $discount->id, 'Updated $discount titled: ' . $discount->title);


        return redirect()->route('discount.index')->with('success','ویرایش انجام شد');
    }


    public function destroy(string $id)
    {
        $discount=Discount::findorFail($id);
        $discount->delete();

        ActivityLog::record('حذف', 'تخفیف', $discount->id, 'Deleted discount titled: ' . $discount->title);


        return redirect()->route('discount.index')->with('success','حذف انجام شد');
    }



    public function searchProducts(Request $request)
    {
        $query = $request->get('q', '');

        $products = Product::query()
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('sku', 'LIKE', "%{$query}%");
            })
            ->select('id', 'name', 'sku')
            ->limit(20)
            ->get();

        return response()->json($products);
    }


    public function changeStatus(Discount $discount)
    {
        $discount->update(['is_active'=>!$discount->is_active]);

        ActivityLog::record('ویرایش', 'تخفیف', $discount->id, 'Updated discount titled: ' . $discount->title);

        return redirect()->route('discount.index')->with('success','وضعیت تغییر کرد');
    }
}
