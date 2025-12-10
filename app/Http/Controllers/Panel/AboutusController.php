<?php

namespace App\Http\Controllers\Panel;
use App\Models\Aboutus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutusController extends Controller
{

    public function index()
    {
        $about = Aboutus::firstOrFail();

        return view('app.aboutus', compact('about'));

    }


    public function edit()
    {

        $about = Aboutus::firstOrFail();

        return view('panel.aboutus.edit', compact('about'));
    }


    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',  // اگر تصویر آپلود میشه
        ]);
        $about = Aboutus::firstOrFail();
        $about->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $validated['image'] ?? null,
        ]);

        if ($request->hasFile('image')) {
            if ($about->image && file_exists(public_path('panel/pictures/' . $about->image))) {
                unlink(public_path('panel/pictures/' . $about->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('panel/pictures'), $filename);

            $about->image = $filename;
            $about->save();
        }

        return redirect()->back()->with('update' , "ویرایش با موفقیت انجام شد");
    }
}
