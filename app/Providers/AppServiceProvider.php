<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Footer;
use App\Models\Setting;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


    public function boot(): void
    {
        View::composer('*', function ($view) {
            $setting = Setting::first();
            $footer = Footer::first();
            $categories = Category::all();

            $cartCount = 0;
            $wishlistCount = 0;

            // کاربر لاگین
            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->first();
                if ($cart) {
                    $cartCount = $cart->items()->sum('quantity');
                }

                $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
            } else {
                $guestToken = Session::get('guest_token');
                if ($guestToken) {
                    $cart = Cart::where('guest_token', $guestToken)->first();
                    if ($cart) {
                        $cartCount = $cart->items()->sum('quantity');
                    }
                }
            }
            view()->composer('*', function ($view) {
                $categories = \App\Models\Category::with('children')->whereNull('parent_id')->get();
                $view->with('headerCategories', $categories);
            });
            view()->composer('*', function ($view) {
                $categories = \App\Models\Category::with('children')->whereNull('parent_id')->get();
                $blogs = Blog::latest()->take(5)->get(); // آخرین 5 مقاله برای منوی هدر
                $view->with('headerCategories', $categories)
                    ->with('headerBlogs', $blogs);
            });
            $view->with(compact('footer', 'categories', 'setting', 'cartCount', 'wishlistCount'));
        });
    }


}
