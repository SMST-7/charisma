<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Shipping;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Footer;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first();
        $footer = Footer::first();
        $shipping = Shipping::first(); // دریافت حمل و نقل از دیتابیس

        return view('panel.setting.edit', compact('setting', 'footer', 'shipping'));
    }


    public function update(Request $request)
    {
        // اعتبارسنجی بخش تنظیمات + فوتر + حمل و نقل
        $request->validate([
            'meta_description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:1024',

            // فوتر
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'phone2' => 'nullable|string',
            'email' => 'nullable|email',
            'instagram' => 'nullable|string',
            'telegram' => 'nullable|string',
            'eitaa' => 'nullable|string',

            // حمل و نقل
            'shipping_name' => 'required|string',
            'shipping_cost' => 'required|numeric',
            'delivery_time' => 'nullable|string',
            'shipping_description' => 'nullable|string',
        ]);

        $setting = Setting::first();
        $footer = Footer::first();
        $shipping = Shipping::first();

        /*
        |--------------------------------------------------------------------------
        | 📌 آپدیت تنظیمات
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {
            $logoName = time() . '_logo.' . $request->logo->extension();
            $request->logo->move(public_path('uploads'), $logoName);
            $setting->logo = 'uploads/' . $logoName;
        }

        if ($request->hasFile('favicon')) {
            $faviconName = time() . '_favicon.' . $request->favicon->extension();
            $request->favicon->move(public_path('uploads'), $faviconName);
            $setting->favicon = 'uploads/' . $faviconName;
        }

        $setting->meta_description = $request->meta_description;
        $setting->save();


        /*
        |--------------------------------------------------------------------------
        | 📌 آپدیت فوتر
        |--------------------------------------------------------------------------
        */

        $footer->update([
            'description' => $request->description,
            'address' => $request->address,
            'phone' => $request->phone,
            'phone2' => $request->phone2,
            'email' => $request->email,
            'instagram' => $request->instagram,
            'telegram' => $request->telegram,
            'eitaa' => $request->eitaa,
        ]);


        /*
        |--------------------------------------------------------------------------
        | 📌 آپدیت حمل و نقل (Shipping)
        |--------------------------------------------------------------------------
        */

        $shipping->update([
            'name'         => $request->shipping_name,
            'cost'         => $request->shipping_cost,
            'delivery_time'=> $request->delivery_time,
            'description'  => $request->shipping_description,
        ]);

        /*
        |--------------------------------------------------------------------------
        | ⚡ لاگ‌گذاری
        |--------------------------------------------------------------------------
        */

        ActivityLog::record('ویرایش', 'تنظیمات', $setting->id, 'Updated setting');
        ActivityLog::record('ویرایش', 'فوتر', $footer->id, 'Updated footer');
        ActivityLog::record('ویرایش', 'حمل‌ونقل', $shipping->id, 'Updated shipping');


        return redirect()->route('setting.edit')->with('success', 'تنظیمات با موفقیت بروزرسانی شد.');
    }
}
