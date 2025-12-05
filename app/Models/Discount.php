<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class Discount extends Model
{
    protected $fillable = [
        'product_id',
        'discount_percentage',
        'is_active',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Scope برای بررسی تخفیف‌های فعال
    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    // Scope برای بررسی تخفیف‌های در بازه زمانی
    public function scopeBetweenStartAndEndDate($query)
    {
        return $query->where('start_date', '<=', now())->where('end_date', '>=', now());
    }

    // متد برای محاسبه قیمت تخفیف‌خورده
    public function getDiscountedPrice()
    {
        if (!$this->product || !$this->isActiveAndValid()) {
            return null; // اگر محصول وجود ندارد یا تخفیف غیرفعال/منقضی است
        }

        $originalPrice = $this->product->price;
        $discountAmount = $originalPrice * ($this->discount_percentage / 100);
        return $originalPrice - $discountAmount;
    }

    // متد برای بررسی وضعیت تخفیف (فعال و در بازه زمانی)
    public function isActiveAndValid()
    {
        return $this->is_active && Carbon::now()->between($this->start_date, $this->end_date);
    }

    // متد برای دریافت زمان باقی‌مانده تا پایان تخفیف (برای شمارش معکوس)
    public function getRemainingTime()
    {
        if (!$this->isActiveAndValid()) {
            return null; // اگر تخفیف منقضی یا غیرفعال است
        }

        $now = Carbon::now();
        $endDate = Carbon::parse($this->end_date);

        if ($endDate->isPast()) {
            $this->update(['is_active' => 0]); // غیرفعال کردن تخفیف منقضی
            return null;
        }

        $remainingSeconds = $now->diffInSeconds($endDate, false);
        if ($remainingSeconds <= 0) {
            $this->update(['is_active' => 0]); // غیرفعال کردن تخفیف
            return null;
        }

        return [
            'days' => floor($remainingSeconds / (60 * 60 * 24)),
            'hours' => floor(($remainingSeconds % (60 * 60 * 24)) / (60 * 60)),
            'minutes' => floor(($remainingSeconds % (60 * 60)) / 60),
            'seconds' => $remainingSeconds % 60,
        ];
    }

    // متد برای تبدیل زمان باقی‌مانده به فرمت شمسی
    public function getRemainingTimeInJalali()
    {
        $remainingTime = $this->getRemainingTime();
        if (!$remainingTime) {
            return null;
        }

        return [
            'days' => $remainingTime['days'],
            'hours' => $remainingTime['hours'],
            'minutes' => $remainingTime['minutes'],
            'seconds' => $remainingTime['seconds'],
            'jalali_end_date' => Jalalian::fromCarbon($this->end_date)->format('Y/m/d H:i:s'),
        ];
    }
}
