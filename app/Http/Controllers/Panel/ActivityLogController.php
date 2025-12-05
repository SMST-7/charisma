<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * نمایش لیست لاگ‌ها
     */
    public function index()
    {
        $logs = ActivityLog::with('user')
            ->latest()
            ->paginate(20); // pagination 20 تا در هر صفحه

        return view('panel.logs.index', compact('logs'));
    }

    /**
     * مشاهده جزئیات یک لاگ
     */
    public function show($id)
    {
        $log = ActivityLog::with('user')->findOrFail($id);
        return view('panel.logs.show', compact('log'));
    }
}
