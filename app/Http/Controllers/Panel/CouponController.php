<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function index()
    {
        $coupons=Coupon::all();
        return view('panel.coupon.index',compact('coupons'));
    }


    public function create()
    {
        return view('panel.coupon.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:20|unique:coupons,code',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'start_date' => 'required|date_format:Y/m/d H:i:s',
            'end_date' => 'required|date_format:Y/m/d H:i:s|after:start_date',
            'active' => 'boolean',
        ]);
        $data=$request->all();

        try {
            $data['start_date'] = \Morilog\Jalali\Jalalian::fromFormat('Y/m/d H:i:s', $data['start_date'])->toCarbon();
            $data['end_date'] = \Morilog\Jalali\Jalalian::fromFormat('Y/m/d H:i:s', $data['end_date'])->toCarbon();
        } catch (Exception $e) {
            return back()->withErrors(['start_date' => 'فرمت تاریخ یا زمان نامعتبر است.'])->withInput();
        }

        $coupon=Coupon::create($data);

        ActivityLog::record('ایجاد', 'کوپن', $coupon->id, 'Created a new coupon titled: ' . $coupon->title);


        return redirect()->route('coupon.index')->with('success', 'کوپن با موفقیت ایجاد شد.');

    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $coupon=Coupon::findorFail($id);
        return view('panel.coupon.edit',compact('coupon'));
    }


    public function update(Request $request, string $id)
    {
        $coupon=Coupon::findorfail($id);

        $request->validate([
            'code' => 'required|string|max:20',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'start_date' => 'required|date_format:Y/m/d H:i:s',
            'end_date' => 'required|date_format:Y/m/d H:i:s|after:start_date',
        ]);
        $data=$request->all();

        try {
            $data['start_date'] = \Morilog\Jalali\Jalalian::fromFormat('Y/m/d H:i:s', $data['start_date'])->toCarbon();
            $data['end_date'] = \Morilog\Jalali\Jalalian::fromFormat('Y/m/d H:i:s', $data['end_date'])->toCarbon();
        } catch (Exception $e) {
            return back()->withErrors(['start_date' => 'فرمت تاریخ یا زمان نامعتبر است.'])->withInput();
        }


        $coupon->update($data);

        ActivityLog::record('ویرایش', 'کوپن', $coupon->id, 'Updated coupon titled: ' . $coupon->title);


        return redirect()->route('coupon.index')->with('success',' ویرایش انجام شد.');
    }


    public function destroy(string $id)
    {
        $coupon=Coupon::findorFail($id);
        $coupon->delete();

        ActivityLog::record('حذف', 'کوپن', $coupon->id, 'Deleted coupon titled: ' . $coupon->title);

        return redirect()->route('coupon.index')->with('success', 'حذف انجام شد.');
    }

    public function toggle(Coupon $coupon)
    {
        $coupon->update(['active' => !$coupon->active]);

        ActivityLog::record('ویرایش', 'کوپن', $coupon->id, 'Deleted coupon titled: ' . $coupon->title);

        return redirect()->route('coupon.index')->with('success', 'وضعیت کوپن با موفقیت تغییر کرد.');
    }


}
