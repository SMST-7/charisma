<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Http\Controllers\App\CartController;

class UserAuthController extends Controller
{
    // نمایش فرم لاگین
    public function showLoginForm(): View
    {
        return view('auth.user.login');
    }

    // پردازش لاگین
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $request->only('username', 'password');
//        \Log::info('User login attempt:', $credentials);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // فراخوانی mergeGuestCart از CartController
            $cartController = new CartController();
            $cartController->mergeGuestCart();

            $request->session()->regenerate();
            return redirect()->route('home')->with('success','خوش آمدید!'); // مسیر بعد از لاگین
        }
        return redirect()->route('user.register')->with('error','شما ثبت نام نکردین!!!!!!');

//        \Log::error('User login failed for username: ' . $request->username);
//        return back()->withErrors([
//            'username' => trans('user.auth.register'),
//        ])->onlyInput('username');
    }

    // نمایش فرم ثبت‌نام
    public function showRegisterForm(): View
    {
        return view('auth.user.register');
    }

    // پردازش ثبت‌نام
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password, // cast 'hashed' هش می‌کنه
            'status' => 0,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('home')->with('success','خوش آمدید!');
    }
}
