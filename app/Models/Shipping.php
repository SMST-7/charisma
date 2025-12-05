<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'name',
        'cost',
        'delivery_time',
        'description',
        'active',
    ];
}
