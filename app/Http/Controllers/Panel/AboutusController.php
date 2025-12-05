<?php

namespace App\Http\Controllers\Panel;
use App\Models\Aboutus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                $about = Aboutus::firstOrFail();

        return view('app.aboutus', compact('about'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit()
    {

        $about = Aboutus::firstOrFail();

        return view('panel.aboutus.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
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

        return redirect()->back()->with('update' , "ویرایش با موفقیت انجام شد");    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
