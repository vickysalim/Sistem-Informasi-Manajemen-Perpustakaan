<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

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

    public function updateLogo(Request $request) {
        $validate = $request->validate([
            'institution_logo' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // get current logo url
            $getCurrentLogoUrl = Setting::where('key', 'institution_logo')->first()->value;

            // delete old logo
            if($getCurrentLogoUrl != "" & file_exists(storage_path('app\\public\\logo\\' . $getCurrentLogoUrl))) {
                File::delete(storage_path('app\\public\\logo\\' . $getCurrentLogoUrl));
            }

            // upload new logo
            $coverFileName = 'logo.' . $validate['institution_logo']->getClientOriginalExtension();
            $validate['institution_logo']->storeAs('public/logo', $coverFileName);
            
            // update logo url in database
            Setting::where('key', 'institution_logo')
                ->update([
                    'value' => $coverFileName
                ]);
        } catch (\Exception $e) {
            return redirect()->route('pengaturan.umum')->with('danger', 'Logo gagal diperbarui.');
        }

        // redirect
        return redirect()->route('pengaturan.umum')->with('success', 'Logo berhasil diperbarui.');
    }
}
