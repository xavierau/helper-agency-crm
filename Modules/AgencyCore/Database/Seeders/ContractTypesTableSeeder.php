<?php

namespace Modules\AgencyCore\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\AgencyContract\Entities\ContractType;
use Modules\AgencyContractDate\Entities\ContractDate;
use Modules\AgencyContractDate\Entities\ContractDateSet;
use Modules\AgencyContractDoc\Entities\ContractDoc;
use Modules\AgencyContractDoc\Entities\ContractDocSet;

class ContractTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $contract_types = [
            'Overseas',
            'Local',
            'Renew',
        ];

        collect($contract_types)->map(fn(
            $data) => factory(ContractType::class)->create(['label' => $data]))
            ->each(function (ContractType $type) {

                ContractDate::all()->each(fn($date, $index) => ContractDateSet::create([
                    'contract_type_id' => $type->id,
                    'contract_date_id' => $date->id,
                    'order'            => $index + 1,
                    'is_required'      => false,
                ]));

                ContractDoc::all()->each(fn($doc, $index) => ContractDocSet::create([
                    'contract_type_id' => $type->id,
                    'contract_doc_id'  => $doc->id,
                    'order'            => $index + 1,
                    'is_required'      => false,
                ]));

            });
    }
}
