<?php

use App\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        collect([
                    'HQ',
                    'Tsuen Wan',
                    'Mong Kok',
                    'Causeway Bay',
                    'Tai po',
                ])->each(function($name) {
            Branch::create([
                               'name' => $name,
                           ]);
        });

    }
}
