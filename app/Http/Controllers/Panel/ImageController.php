<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
//use App\Models\General;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    private $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    public function index()
    {
        $settings = Setting::first();
        return view('panel.EditImages.watermarkedImage', compact('settings'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'ImageWidth' => 'nullable|numeric|min:1',
                'ImageHeight' => 'nullable|numeric|min:1',
                'LogoWidth' => 'nullable|numeric|min:1',
                'LogoHeight' => 'nullable|numeric|min:1'
            ]);

            // تولید نام یکتا برای جلوگیری از بازنویسی
            $imageFile = $request->file('image');
            $imageExtension = $imageFile->getClientOriginalExtension();
            $imageName = Str::random(40) . '.' . $imageExtension;

            // ذخیره موقت تصویر اصلی
            $tempPath = public_path('panel/temp/' . $imageName);
            $imageFile->move(public_path('panel/temp'), $imageName);


            // مسیر نسبی برای نمایش تصویر اصلی
//            $originalImagePath = 'images/temp/' . $imageName;


            // گرفتن مسیر لوگو از دیتابیس
            $logoName = Setting::query()->value('logo');
            if (!$logoName) {
                unlink($tempPath);
                return back()->with('error', 'لوگو در دیتابیس یافت نشد');
            }

            // خواندن تصاویر
            $thumbImage = $this->imageManager->read($tempPath);
            $watermarkImage = $this->imageManager->read(public_path('panel/' . $logoName));

            // تغییر اندازه تصویر اصلی (در صورت وجود مقادیر)
            if ($validated['ImageWidth'] && $validated['ImageHeight']) {
                $thumbImage->resize($validated['ImageWidth'], $validated['ImageHeight']);
            }

            // تغییر اندازه لوگو
            $logoWidth = $validated['LogoWidth'] ?? 100;
            $logoHeight = $validated['LogoHeight'] ?? 100;
            $watermarkImage->resize($logoWidth, $logoHeight);

            // افزودن واترمارک
            $thumbImage->place($watermarkImage, 'bottom-right', 25, 25, 90);

            // ذخیره تصویر نهایی
            $finalPath = 'panel/watermarkedImage/' . $imageName;
            $response = $thumbImage->save(public_path($finalPath));

            // حذف فایل موقت
            if (file_exists($tempPath)) {
                unlink($tempPath);
            }

            if ($response) {
                return back()->with('success', 'تصویر با موفقیت آپلود و واترمارک شد')
                    ->with('thumbImage', $finalPath)
                    ->with('logoName', $logoName);
            }

            return back()->with('error', 'خطا در ذخیره تصویر واترمارک‌شده');
        } catch (\Exception $e) {
            // حذف فایل موقت در صورت بروز خطا
            if (isset($tempPath) && file_exists($tempPath)) {
                unlink($tempPath);
            }
            return back()->with('error', 'خطایی رخ داد: ' . $e->getMessage());
        }
    }
}


