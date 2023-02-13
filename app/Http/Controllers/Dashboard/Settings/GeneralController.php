<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;

class GeneralController extends Controller
{
    public function index() {
        $settingsData = Setting::all();
        return view('pages.dashboard.pengaturan.umum', compact('settingsData'));
    }
}
