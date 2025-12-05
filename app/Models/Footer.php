<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $table = 'footer';

    protected $fillable = [
        'description',
        'address',
        'phone',
        'phone2',
        'email',
        'instagram',
        'telegram',
        'eitaa',
    ];
}
