<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $settings = [
            [
                'label' => 'Default Salary',
                'code'  => 'salary',
                'value' => 4630,
            ],
            [
                'label' => 'Default Food Subsidy',
                'code'  => 'food_subsidy',
                'value' => 1121,
            ],
        ];

        foreach($settings as $setting) {
            Setting::firstOrCreate([
                                       'code' => $setting['code'],
                                   ],
                                   [
                                       'label' => $setting['label'],
                                       'value' => $setting['value'],
                                   ]);
        }
    }
}
