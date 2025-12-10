<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{

    public function index()
    {
        $banners=Banner::all();
        return view('panel.banner.index',compact('banners'));
    }


    public function create()
    {
        return view('panel.banner.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'=>'nullable|string|max:255',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link'=>'nullable|string|max:255',
        ]);

        $data=$request->all();

        $destinationPath=base_path('public/panel/banner/');

        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $fileName);
            $data['image'] = $fileName;
        }
        $banner=Banner::create($data);
        ActivityLog::record('ایجاد', 'بنر', $banner->id, 'Created a new banner titled: ' . $banner->title);


        return redirect()->route('banner.index')->with('insert', 'بنر با موفقیت اضافه شد');

    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $banner=Banner::findorFail($id);
        return view('panel.banner.edit',compact('banner'));
    }


    public function update(Request $request, string $id)
    {
        $banner=Banner::findorFail($id);
        $request->validate([
            'title'=>'nullable|string|max:255',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean',
            'link'=>'nullable|string|max:255',
        ]);

        $data=$request->all();

        $destinationPath = base_path('public/panel/banner/');


        // به‌روزرسانی تصویر
        if ($request->hasFile('image')) {
            if ($banner->image && File::exists($destinationPath . $banner->image)) {
                File::delete($destinationPath . $banner->image);
            }
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $fileName);
            $data['image'] = $fileName;

        } elseif ($request->filled('remove_image') && $banner->image) {
            if (File::exists($destinationPath . $banner->image)) {
                File::delete($destinationPath . $banner->image);
            }
            $data['image'] = null;
        }

        $banner->update($data);

        ActivityLog::record('ویرایش', 'بنر', $banner->id, 'Updated banner titled: ' . $banner->title);

        return redirect()->route('banner.index')->with('update', 'ویرایش با موفقیت انجام شد');



    }


    public function destroy(string $id)
    {
        $banner = banner::findOrFail($id);
        $destinationPath = base_path('public/panel/banner/');

        // حذف تصویر  (image)
        if ($banner->image && File::exists($destinationPath . $banner->image)) {
            File::delete($destinationPath . $banner->image);
        }

        // حذف بنر
        $banner->delete();

        ActivityLog::record('حذف', 'بنر', $banner->id, 'Deleted banner titled: ' . $banner->title);


        return redirect()->route('banner.index')->with('delete', 'بنر با موفقیت حذف شد');
    }
}
