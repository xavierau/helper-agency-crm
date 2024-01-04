<?php

namespace Modules\AgencyCore\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\AgencyCore\Entities\Variant;

class VariantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        collect([
                    'Filipino',
                    'Indonesian',
                    'Cambodian',
                    'OE/LE',
                    'TH',
                ])->each(function($name) {
            Variant::create(['name' => $name]);
        });
    }
}
