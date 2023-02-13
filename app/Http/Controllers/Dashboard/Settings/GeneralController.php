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

    public function update(Request $request) {
        $validate = $request->validate([
            'institution_name' => 'required',
            'institution_city' => 'required',
            'institution_address' => 'required',
            'principal' => 'required',
            'head_librarian' => 'required',
            'loan_duration' => 'required',
            'fine' => 'required',
            'extend_limit' => 'required'
        ]);

        try {
            $settingsData = Setting::all()->whereNotIn('key', ['institution_logo']);
    
            // update the settings data with the new value from the form input
            foreach ($settingsData as $setting) {
                $setting->value = $request->input($setting->key);
                $setting->save();
            }
        } catch (\Exception $e) {
            return redirect()->route('pengaturan.umum')->with('danger', 'Pengaturan gagal diperbarui.');
        }

        // redirect
        return redirect()->route('pengaturan.umum')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
