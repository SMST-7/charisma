<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {

            if (Auth::user()->isAdmin()) {

                return redirect()->route('profile.edit')->with('success','خوش آمدید!');
            }
            Auth::logout();
            return redirect()->route('home')->withErrors(['error' => 'فقط ادمین‌ها می‌توانند وارد شوند']);
        }

        return back()->withErrors(['error' => 'نام کاربری یا رمز عبور اشتباه است']);
    }

    public function index()
    {
        return view('profile.edit');
    }


    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.admin.login');

    }
}
