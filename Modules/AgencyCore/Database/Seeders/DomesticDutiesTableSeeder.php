<?php

namespace Modules\AgencyCore\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\AgencyCore\Entities\DomesticDuty;
use Modules\AgencyCore\Services\DefaultDomesticDuties;

class DomesticDutiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $duties = DefaultDomesticDuties::get();

        foreach ($duties as $duty) {
            DomesticDuty::firstOrCreate($duty);
        }
    }
}
