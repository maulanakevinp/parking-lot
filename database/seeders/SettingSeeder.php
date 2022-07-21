<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Setting::truncate();
        Setting::create([
            'price_per_hour' => '1000.00',
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
