<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Contactus;
use Illuminate\Http\Request;

class ContactusController extends Controller
{

    public function index()
    {
        // 10 پیام در هر صفحه
        $messages = Contactus::orderBy('created_at', 'desc')->paginate(10);

        return view('panel.contactus.index', compact('messages'));
    }


    public function create()
    {
        return view('app.contactus');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => ['required', 'string', 'min:3', 'max:150', 'regex:/^[\pL\s]+$/u'],
            'phone' => ['required', 'digits:11', 'regex:/^09\d{9}$/'],
            'message' => ['required', 'string', 'min:5', 'max:1000'],
        ], [
            'phone.regex'      => 'شماره همراه معتبر نیست (باید با 09 شروع شود و ۱۱ رقم باشد).',
        ]);

//        dd($validated);
        $contactus=Contactus::create([
            'fname'   => $validated['fname'],
            'phone'   => $validated['phone'],
            'message' => $validated['message'],
        ]);


//        ActivityLog::record('ایجاد', 'ارتباط با ما', $contactus->id, 'Created a new contactus titled: ' . $contactus->title);


        return redirect()->back()->with('success', "با موفقیت ثبت شد");
    }



    public function show(string $id)
    {
   $message = Contactus::findOrFail($id);
return view('panel.contactus.show', compact('message'));
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
    public function toggleStatus($id)
    {
        $message = Contactus::findOrFail($id);
        $message->status = $message->status ? 0 : 1; // اگر 1 بود میشه 0، اگر 0 بود میشه 1
        $message->save();

        ActivityLog::record('ویرایش', 'ارتباط با ما', $message->id, 'Deleted message titled: ' . $message->title);

        return redirect()->back()->with('status', 'وضعیت پیام با موفقیت تغییر کرد');
    }

}
