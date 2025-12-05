<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::all();
        return view('panel.service.index', compact('services'));
    }


    public function create()
    {
        return view('panel.service.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description'=>'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data=$request->all();
        $destinationPath = public_path('panel/pictures/');

        $filePath = null;
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $fileName);
            $data['image'] = $fileName;
        }
        $service=Service::create($data);

        ActivityLog::record('ایجاد', 'سرویس', $service->id, 'Created a new service titled: ' . $service->title);


        return redirect()->route('service.index')->with('insert', 'سرویس با موفقیت اضافه شد');


    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $service=Service::findorFail($id);
        return view('panel.service.edit',compact('service'));
    }


    public function update(Request $request, string $id)
    {
        $service=Service::findorFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description'=>'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean',
            'is_active' => 'required|in:0,1', // اعتبارسنجی برای is_active
        ]);

        $data = $request->all();
        $destinationPath = public_path('panel/pictures/');

        // به‌روزرسانی تصویر توضیحات
        if ($request->hasFile('image')) {
            if ($service->image && File::exists($destinationPath . $service->image)) {
                File::delete($destinationPath . $service->image);
            }
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $fileName);
            $data['image'] = $fileName;
        } elseif ($request->filled('remove_image') && $service->image) {
            if (File::exists($destinationPath . $service->image)) {
                File::delete($destinationPath . $service->image);
            }
            $data['image'] = null;
        }
        $service->update($data);

        ActivityLog::record('ویرایش', 'سرویس', $service->id, 'Updated service titled: ' . $service->title);

        return redirect()->route('service.index')->with('update', 'ویرایش با موفقیت انجام شد');
    }


    public function destroy(string $id)
    {
        $service=Service::findorFail($id);
        // حذف تصویر اگر وجود داشته باشد
        if ($service->image && File::exists(public_path('panel/pictures/' . $service->image))) {
            File::delete(public_path('panel/pictures/' . $service->image));
        }

        $service->delete();

        ActivityLog::record('حذف', 'سرویس', $service->id, 'Deleted service titled: ' . $service->title);


        return redirect()->route('service.index')->with('delete', 'سرویس با موفقیت حذف شد');
    }

    public function toggle(Service $service)
    {
        $service->update(['is_active' => !$service->is_active]);

        ActivityLog::record('ویرایش', 'سرویس', $service->id, 'Updated service titled: ' . $service->title);

        return redirect()->route('service.index')->with('success', 'وضعیت سرویس با موفقیت تغییر کرد.');
    }

}
