<?php

namespace Modules\AgencyContractDate\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\AgencyContractDate\Entities\ContractDate;

class AgencyContractDateDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        $dates = [
            [
                'label' => 'Expecting arrival date',
                'group' => 'Basic document date',
            ],
            [
                'label' => 'Sign contract date',
                'group' => 'Basic document date',
            ],
            [
                'label' => 'Processing the Date',
                'group' => 'Basic document date',
            ],
            [
                'label' => 'Doc. sent to MO date',
                'group' => 'Basic document date',
            ],
            [
                'label' => 'Insurance submitting date',
                'group' => 'Insurance Information',
            ],
            [
                'label' => 'Insurance effective date',
                'group' => 'Insurance Information',
            ],
            [
                'label' => 'Insurance expired date',
                'group' => 'Insurance Information',
            ],
            [
                'label' => 'Contract submit date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Immi. submit date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Immi. Case no.',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Immi. Log no. date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => '1st Subsidiary doc date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => '2nd Subsidiary doc date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => '3rd Subsidiary doc date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Medical date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Starting date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Visa expiry date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Terminated date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Release visa date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Visa expired date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Courier contract date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Courier visa date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Expecting arrival date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Flight date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Arrival date',
                'group' => 'Oversea application processing date',
            ],
            [
                'label' => 'Pickup HKID date',
                'group' => 'Oversea application processing date',
            ],
        ];

        collect($dates)->each(fn($data) => ContractDate::create($data));

    }
}
