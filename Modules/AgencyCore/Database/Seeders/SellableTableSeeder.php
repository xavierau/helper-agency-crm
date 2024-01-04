<?php

namespace Modules\AgencyCore\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\AgencyCore\Entities\Sellable;

class SellableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        $sellables = [
            [
                'name'        => 'Plan A',
                'description' => 'this is plan A description',
                'editable'    => false,
            ],
            [
                'name'        => 'Plan B',
                'description' => 'this is plan B description',
                'editable'    => false,
            ],
            [
                'name'        => 'Plan C',
                'description' => 'this is plan C description',
                'editable'    => false,
            ],
            [
                'name'        => 'Plan D',
                'description' => 'this is plan D description',
                'editable'    => false,
            ],
            [
                'name'        => 'Plan E',
                'description' => 'this is plan E description',
                'editable'    => false,
            ],
            [
                'name'        => 'Plan F',
                'description' => 'this is plan F description',
                'editable'    => false,
            ],
            [
                'name'        => 'Insurance',
                'description' => 'this is insurance description',
                'editable'    => true,
            ],
            [
                'name'        => 'Flight',
                'description' => 'this is plan flight description',
                'editable'    => true,
            ],
            [
                'name'        => 'Medical Check',
                'description' => 'this is medical check description',
                'editable'    => true,
            ],
            ['name' => 'Other', 'description' => 'this is other description', 'editable' => true],
        ];

        collect($sellables)->each(fn(array $data
        ): Sellable => factory(Sellable::class)->create($data));
    }
}
