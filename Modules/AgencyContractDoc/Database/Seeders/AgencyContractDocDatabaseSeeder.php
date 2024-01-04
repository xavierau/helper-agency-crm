<?php

namespace Modules\AgencyContractDoc\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\AgencyContractDoc\Entities\ContractDoc;

class AgencyContractDocDatabaseSeeder extends Seeder
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
                'label' => 'Employer’s HKID Card',
                'group' => 'Employer Basic Document',
            ],
            [
                'label' => 'Financial Information',
                'group' => 'Employer Basic Document',
            ],
            [
                'label' => 'Address Proof',
                'group' => 'Employer Basic Document',
            ],
            [
                'label' => 'Existing or Terminated Helper Contract',
                'group' => 'Employer Basic Document',
            ],
            [
                'label' => '407E Form with Existing / Previous Helper',
                'group' => 'Employer Basic Document',
            ],
            [
                'label' => 'Covid-19 Quarantine Undertaking',
                'group' => 'Employer Basic Document',
            ],
            [
                'label' => 'Covid-19 Quarantine Undertaking',
                'group' => 'Employer Basic Document',
            ],
            [
                'label' => 'Employer Authorization Letter (Pickup Visa)',
                'group' => 'Employer Basic Document',
            ],
            [
                'label' => 'Expedite Letter',
                'group' => 'Employer Document',
            ],
            [
                'label' => 'Additional Helper Letter',
                'group' => 'Employer Document',
            ],
            [
                'label' => 'Supporter HKID Card',
                'group' => 'Employer Document',
            ],
            [
                'label' => 'Support Letter',
                'group' => 'Employer Document',
            ],
            [
                'label' => 'Explanation Letter',
                'group' => 'Employer Document',
            ],
            [
                'label' => 'Public Housing/Private Housing Tenancy Agreement',
                'group' => 'Employer Document',
            ],
            [
                'label' => 'Temporary Stay Letter',
                'group' => 'Employer Document',
            ],
            [
                'label' => 'Company Housing allowance Letter',
                'group' => 'Employer Document',
            ],
            [
                'label' => 'Salary Receipt',
                'group' => 'Employer Document',
            ],
            [
                'label' => 'Indo or Bang or Sri Lanka Guarantee Letter/ Phil OWWA Letter',
                'group' => 'Employer Document',
            ],
            [
                'label' => 'Round Trip Ticket',
                'group' => 'Employer Document',
            ],
            [
                'label' => 'Single Trip Ticket',
                'group' => 'Employer Document',
            ],
            [
                'label' => 'Subsidiary Document',
                'group' => 'Employer Document',
            ],
        ];

        collect($dates)->each(fn($data) => ContractDoc::create($data));

    }
}
