<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.profile.edit');
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
    public function edit(Request $request): View
    {
//        $user=$request->user();
//        dd($user);
        return  view('app.profile.edit',[
            'user'=>$request->user()
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        // Check if user exists and is active
        if ($user && $user->status == 0) {
            // Validate the request
            $request->validate([
                'name' => ['nullable', 'string', 'max:255'],
                'username' => ['nullable', 'string', 'max:255', 'unique:users,username,' . $user->id],
                'current_password' => ['required', 'string'],
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            ]);

            // Verify current password
            if (!Hash::check($request->current_password, $user->password)) {
                return Redirect::route('user.profile')->withErrors(['current_password' => 'رمز عبور فعلی اشتباه است.']);
            }

            // Prepare data for update
            $updateData = [
                'name' => $request->name ?? $user->name,
                'username' => $request->username ?? $user->username,
            ];

            // Update password if provided
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            // Update user
            $user->update($updateData);

            return Redirect::route('user.profile')->with('success', 'پروفایل با موفقیت به‌روزرسانی شد.');
        }

        return Redirect::route('user.profile')->withErrors(['error' => 'کاربر یافت نشد یا غیرفعال است.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request):RedirectResponse
    {
        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('home')->with('success','حساب کاربری شما حذف شد');
    }
}
