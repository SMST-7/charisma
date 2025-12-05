<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['fname', 'phone', 'message'];

}
