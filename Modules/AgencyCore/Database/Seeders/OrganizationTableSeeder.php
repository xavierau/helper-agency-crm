<?php

namespace Modules\AgencyCore\Database\Seeders;

use Anacreation\Organization\Entities\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class OrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        $ogranizations = [
            [
                'label'     => 'Headquarter',
                'parent_id' => null,
            ],
            [
                'label'     => 'Tsuen Wan Branch',
                'parent_id' => 1,
            ],
            [
                'label'     => 'Mong Kok Branch',
                'parent_id' => 1,
            ],
        ];

        foreach($ogranizations as $ogranization) {
            Organization::create($ogranization);
        }
    }
}
