<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = [
        'user_id',
        'title',
        'fname',
        'phone',
        'province',
        'city',
        'address',
        'postal_code',
        'default',
    ];


}
