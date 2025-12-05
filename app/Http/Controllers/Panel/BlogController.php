<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {

        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10); // 10 مورد در هر صفحه



        return view('panel.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('panel.blogs.create');
    }





    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100|min:2|unique:blogs,title',
            'content' => 'required|string|min:10',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'reference_url' => 'nullable|url',
            'reference_name' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        // ذخیره تصویر مستقیم در public/uploads/blogs
        if ($request->hasFile('image')) {
            $destinationPath = public_path('uploads/blogs/');
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $fileName);
            $data['image'] = $fileName;
        }

        $blog=Blog::create($data);



        ActivityLog::record('ایجاد', 'بلاگ', $blog->id, 'Created a new blog titled: ' . $blog->title);


        return redirect()->route('blogs.index')->with('success', 'پست با موفقیت ایجاد شد.');
    }



    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('panel.blogs.edit', compact('blog'));
    }




    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title'          => 'required|string|max:100|min:2|unique:blogs,title,' . $blog->id,
            'content'        => 'required|string|min:10',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'reference_url'  => 'nullable|url|max:500',
            'reference_name' => 'nullable|string|max:255',
            'remove_image'   => 'sometimes|in:1,true,on', // فقط اگر تیک خورده باشه
        ]);

        $data = [
            'title'          => $validated['title'],
            'content'        => $validated['content'],
            'reference_url'  => $validated['reference_url'] ?? null,
            'reference_name' => $validated['reference_name'] ?? null,
        ];

        // مدیریت تصویر
        if ($request->hasFile('image')) {
            // حذف تصویر قبلی
            if ($blog->image && File::exists(public_path('uploads/blogs/' . $blog->image))) {
                File::delete(public_path('uploads/blogs/' . $blog->image));
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/blogs'), $fileName);
            $data['image'] = $fileName;

        } elseif ($request->has('remove_image') && $request->remove_image) {
            // حذف تصویر اگر تیک "حذف تصویر" خورده باشه
            if ($blog->image && File::exists(public_path('uploads/blogs/' . $blog->image))) {
                File::delete(public_path('uploads/blogs/' . $blog->image));
            }
            $data['image'] = null;

        } else {
            // تصویر قبلی حفظ شود
            $data['image'] = $blog->image;
        }

        $blog->update($data);

        ActivityLog::record('ویرایش', 'بلاگ', $blog->id, 'ویرایش بلاگ: ' . $blog->title);

        return redirect()->route('blogs.index')->with('success', 'پست بلاگ با موفقیت به‌روزرسانی شد.');
    }


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->image && File::exists(public_path('uploads/blogs/' . $blog->image))) {
            File::delete(public_path('uploads/blogs/' . $blog->image));
        }

        $blog->delete();

        ActivityLog::record('حذف', 'بلاگ', $blog->id, 'Deleted blog titled: ' . $blog->title);


        return redirect()->route('blogs.index')->with('success', 'پست با موفقیت حذف شد.');
    }
}
