<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    protected $fillable = [
        'action',
        'model_type',
        'model_id',
        'description',
        'user_id'
    ];

    /**
     * ارتباط با مدل User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ثبت لاگ برای اقدامات مختلف
     *
     * @param string $action نوع عملیات (created, updated, deleted, etc.)
     * @param mixed $model مدل مورد نظر
     * @param int|null $modelId شناسه مدل (اختیاری)
     * @return ActivityLog
     */
    public static function record($action, $model, $modelId = null)
    {
        $modelType = class_basename($model);
        $actionText = match ($action) {
            'created' => 'ایجاد شد',
            'updated' => 'ویرایش شد',
            'deleted' => 'حذف شد',
            default => $action
        };

        $message = "رکوردی از مدل {$modelType} {$actionText} شد.";

        // ذخیره در دیتابیس
        $log = self::create([
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'description' => $message,
            'user_id' => Auth::id(),
        ]);

        // ذخیره لاگ در فایل بک‌آپ
        try {
            $logEntry = sprintf(
                "[%s] User: %s, Action: %s, Model: %s, Model ID: %s, Description: %s\n",
                now()->timezone('Asia/Tehran')->format('Y/m/d H:i:s'),
                Auth::user() ? Auth::user()->username : 'Unknown',
                $action,
                $modelType,
                $modelId ?? 'N/A',
                $message
            );

            $logFilePath = storage_path('logs/logs.txt');
            file_put_contents($logFilePath, $logEntry, FILE_APPEND | LOCK_EX);
        } catch (\Exception $e) {
            \Log::error('Failed to write to logs.txt: ' . $e->getMessage());
        }

        return $log;
    }
}
