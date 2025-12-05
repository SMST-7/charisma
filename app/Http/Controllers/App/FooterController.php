<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\Setting;
use Illuminate\Http\Request;

class FooterController extends Controller
{

    public function index()
    {
        $setting = Setting::first();
        $footer = Footer::first();

        return view('app.home.footer', compact('setting', 'footer'));
    }

}
