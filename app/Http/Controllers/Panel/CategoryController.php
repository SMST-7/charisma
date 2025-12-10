<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
class CategoryController extends Controller
{

    public function index()
    {
        // 10 دسته‌بندی در هر صفحه
        $categories = Category::with('parent')->paginate(10);

        return view('panel.category.index', compact('categories'));
    }


    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('panel.category.create', compact('categories'));
    }



    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(base_path('public/panel/pictures'), $fileName);
            $filePath = $fileName;
        }

        $category = Category::create([
            'title' => $validated['title'],
            'parent_id' => $validated['parent_id'] ?: null,
            'image' => $filePath,
        ]);

        // ثبت لاگ برای ایجاد دسته‌بندی
        ActivityLog::record('ایجاد', 'دسته‌بندی محصولات', $category->id, 'Created a new category titled: ' . $category->title);

        return redirect()->route('category.index')->with('insert','دسته بندی با موفقیت اضافه شد');
    }


    public function show(string $id)
    {
        //
    }


    public function edit($slug)
    {
        $category=Category::where('slug',$slug)->firstorFail();
        $categories = Category::where('id', '!=', $category->id)->whereNull('parent_id')->get();
        return view('panel.category.edit', compact('category', 'categories'));
    }


    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);
        $filePath = $category->image;

        // پردازش تصویر
        if ($request->hasFile('image')) {
            // حذف تصویر قدیمی اگر وجود داشته باشد
            if ($category->image && File::exists(base_path('public/panel/pictures/' . $category->image))) {
                File::delete(base_path('public/panel/pictures/' . $category->image));
            }
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(base_path('public/panel/pictures/'), $fileName);
            $filePath = $fileName;
        } elseif ($request->filled('remove_image') && $category->image) {
            // حذف تصویر و تنظیم مقدار null
            if (File::exists(base_path('public/panel/pictures/' . $category->image))) {
                File::delete(base_path('public/panel/pictures/' . $category->image));
            }
            $filePath = null;
        }

        $category->update([
            'title' => $validated['title'],
            'parent_id' => $validated['parent_id'] ?: null,
            'image' => $filePath,
        ]);

        // ثبت لاگ برای ویرایش دسته‌بندی
        ActivityLog::record('ویرایش', 'دسته‌بندی محصولات', $category->id, 'Updated category titled: ' . $category->title);
        return redirect()->route('category.index')->with('update','دسته بندی با موفقیت ویرایش شد');
    }


    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // جلوگیری از حذف اگر دسته‌بندی زیرمجموعه دارد
        if ($category->children()->exists()) {
            return redirect()->route('category.index')->with('error', 'نمی‌توان دسته‌بندی را حذف کرد زیرا دارای زیرمجموعه است.');
        }

        // حذف تصویر اگر وجود داشته باشد
        if ($category->image && File::exists(base_path('public/panel/pictures/' . $category->image))) {
            File::delete(base_path('public/panel/pictures/' . $category->image));
        }

        // ثبت لاگ برای حذف دسته‌بندی
        ActivityLog::record('حذف', 'دسته‌بندی محصولات', $category->id, 'Deleted category titled: ' . $category->name);
        $category->delete();
        return redirect()->route('category.index')->with('delete', 'دسته‌بندی با موفقیت حذف شد');
    }


    public function changeStatus(Category $category)
    {
        $category->update(['is_active'=>!$category->is_active]);
        ActivityLog::record('ویرایش وضعیت', 'دسته‌بندی محصولات', $category->id, 'Updated  category titled: ' . $category->name);

        return redirect()->route('category.index')->with('success','وضعیت تغییر کرد');
    }
}
