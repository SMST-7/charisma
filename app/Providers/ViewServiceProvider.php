<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ActivityLog;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // View Composer برای هدر
        View::composer('panel.layouts.header', function ($view) {
            $recentLogs = ActivityLog::with('user')->latest()->take(5)->get();
            $view->with('logs', $recentLogs);
        });
    }
}
