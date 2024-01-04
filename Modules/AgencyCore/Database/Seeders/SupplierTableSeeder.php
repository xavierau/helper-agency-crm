<?php

namespace Modules\AgencyCore\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\AgencyCore\Entities\Supplier;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(Supplier::class,
                15)->create();
    }
}
