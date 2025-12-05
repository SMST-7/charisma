<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes=Attribute::all();
        return view('panel.attribute.index',compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attribute=Attribute::find($id);
        return view('panel.attribute.edit',compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attribute=Attribute::findorFail($id);
        $attribute->delete();

        ActivityLog::record('حذف', 'ویژگی', $attribute->id, 'Deleted attribute titled: ' . $attribute->title);

        return redirect()->route('attribute.index')->with('success', 'ویژگی با موفقیت حذف شد');
    }
}
