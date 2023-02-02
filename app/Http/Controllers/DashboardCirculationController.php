<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Circulation;
use App\Models\Setting;

class DashboardCirculationController extends Controller
{
    public function index() {
        $fineData = Setting::where('key', 'fine')->first();
        $circulationData = Circulation::all()->where('status', 'Berjalan');
        return view('pages.dashboard.sirkulasi', compact('fineData', 'circulationData'));
    }
}
