<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'key' => 'loan_duration',
            'value' => '2'
        ]);

        Setting::create([
            'key' => 'fine',
            'value' => '2000'
        ]);

        Setting::create([
            'key' => 'extend_limit',
            'value' => '3'
        ]);

        Setting::create([
            'key' => 'head_librarian',
            'value' => 'Head Librarian Name'
        ]);

        Setting::create([
            'key' => 'principal',
            'value' => 'Principal Name'
        ]);

    }
}
