<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    // ثبت آدرس جدید
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'fname'       => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'province'    => 'required|string',
            'city'        => 'required|string',
            'address'     => 'required|string',
            'postal_code' => 'required|string|max:10',
        ]);

        $validated['user_id'] = $user->id;
        $validated['default'] = 0;

        Address::create($validated);

        return redirect()->route('checkout.index')->with('success', 'آدرس با موفقیت ثبت شد.');
    }

    // حذف آدرس
    public function destroy($id)
    {
        $user = Auth::user();

        $address = Address::where('id', $id)
            ->where('user_id', $user->id) // فقط آدرس‌های خود کاربر
            ->first();

        if (!$address) {
            return redirect()->route('checkout.index')->with('error', 'آدرس مورد نظر یافت نشد.');
        }

        $address->delete();

        return redirect()->route('checkout.index')->with('success', 'آدرس با موفقیت حذف شد.');
    }
}
