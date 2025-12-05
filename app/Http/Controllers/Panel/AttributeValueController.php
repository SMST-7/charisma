<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{

    public function index()
    {
        // گروه‌بندی مقادیر بر اساس attribute_id
        $grouped_values = AttributeValue::with('attribute')
            ->get()
            ->groupBy('attribute_id')
            ->map(function ($items) {
                return [
                    'attribute' => $items->first()->attribute,
                    'values'    => $items->pluck('value')->implode(' ، '),
                    'value_objects' => $items // برای دسترسی به هر مقدار در ویو
                ];
            })
            ->values(); // برای ایندکس‌های متوالی

        return view('panel.attribute_values.index', compact('grouped_values'));
    }



    public function create()
    {
        $attributes = Attribute::all();
        $selected_attribute_id = request('attribute_id'); // از URL می‌گیره
        return view('panel.attribute_values.create', compact('attributes', 'selected_attribute_id'));
    }

    public function store(Request $request)
    {
        $validated=$request->validate([
            'attribute_id'=>'required|integer|exists:attributes,id',
            'value'=>'required|string|max:225',
        ]);
        $data=$request->all();
        $attribute_values=AttributeValue::create($data);


        ActivityLog::record('ایجاد', ' مقادیر ویژگی', $attribute_values->id, 'Created a new AttributeValue titled: ' . $attribute_values->title);

        return redirect()->route('attribute_values.index')->with('success','مقادیر ویژگی با موفقیت اضافه شد');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $attribute_value=AttributeValue::findorFail($id);
        $attributes=Attribute::with('attributeValues')->where('id','!=',$attribute_value->attribute_id)->get();

        return view('panel.attribute_values.edit',compact('attributes','attribute_value'));

    }


    public function update(Request $request, string $id)
    {
        $attribute_value=AttributeValue::findorFail($id);
        $request->validate([
            'attribute_id'=>'required|integer|exists:attributes,id',
            'value'=>'required|string|max:225',
        ]);
        $data=$request->all();

        $attribute_value->update($data);

        ActivityLog::record('ویرایش', ' مقادیر ویژگی', $attribute_value->id, 'Updated AttributeValue titled: ' . $attribute_value->title);


        return redirect()->route('attribute_values.index')->with('success','ویرایش با موفقیت انجام شد');
    }


    public function destroy(string $id)
    {
        $attribute_value=AttributeValue::findorFail($id);
        $attribute_value->delete();

        ActivityLog::record('حذف', ' مقادیر ویژگی', $attribute_value->id, 'Deleted AttributeValue titled: ' . $attribute_value->title);

        return redirect()->route('attribute_values.index')->with('success','با موفقیت حذف شد');
    }
}
