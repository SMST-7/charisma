<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{

    public function index()
    {
        $attributes=Attribute::all();
        return view('panel.attribute.index',compact('attributes'));
    }


    public function create()
    {
        return view('panel.attribute.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $attribute = Attribute::create([
            'name' => $validated['name'],
        ]);

        ActivityLog::record('ایجاد', 'ویژگی', $attribute->id, 'Created a new attribute titled: ' . $attribute->title);


        return redirect()->route('attribute.index')->with('success','ویژگی با موفقیت اضافه شد');

    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $attribute=Attribute::find($id);
        return view('panel.attribute.edit',compact('attribute'));
    }


    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $attribute=Attribute::findorFail($id);

        $attribute->update([
            'name'=>$validated['name'],
        ]);


        ActivityLog::record('ویرایش', 'ویژگی', $attribute->id, 'Updated attribute titled: ' . $attribute->title);

        return redirect()->route('attribute.index')->with('success','ویژگی با موفقیت ویرایش شد');

    }

    public function destroy(string $id)
    {
        $attribute=Attribute::findorFail($id);
        $attribute->delete();

        ActivityLog::record('حذف', 'ویژگی', $attribute->id, 'Deleted attribute titled: ' . $attribute->title);

        return redirect()->route('attribute.index')->with('success', 'ویژگی با موفقیت حذف شد');
    }
}
