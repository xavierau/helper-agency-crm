<?php

use App\Nationality;
use Illuminate\Database\Seeder;

class NationalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $nationalities = [
            [
                'label' => 'Indonesian',
                'code'  => 'IH',
            ],
            [
                'label' => 'Filipino',
                'code'  => 'FH',
            ],
            [
                'label' => 'Thai',
                'code'  => 'TH',
            ],
            [
                'label' => 'Nepalese',
                'code'  => 'NH',
            ],
            [
                'label' => 'Sri Lankan',
                'code'  => 'SH',
            ],
            [
                'label' => 'Bangladeshi',
                'code'  => 'BH',
            ],
            [
                'label' => 'Malaysian',
                'code'  => 'MH',
            ],
            [
                'label' => 'Kenyan',
                'code'  => 'KH',
            ],
            [
                'label' => 'Cambodian',
                'code'  => 'CH',
            ],
        ];


        collect($nationalities)->each(fn($data) => Nationality::create($data));
    }
}
