<?php

namespace App\Traits;

use Morilog\Jalali\Jalalian;
use Carbon\Carbon;

trait JalaliTimestamps
{
    public function getCreatedAtAttribute($value)
    {
        if (!$value) {
            return null;
        }

        $date = Carbon::parse($value)->setTimezone('Asia/Tehran');
        return Jalalian::fromCarbon($date)->format('d F Y');
    }

    public function getUpdatedAtAttribute($value)
    {
        if (!$value) {
            return null;
        }

        $date = Carbon::parse($value)->setTimezone('Asia/Tehran');
        return Jalalian::fromCarbon($date)->format('d F Y');
    }
}
