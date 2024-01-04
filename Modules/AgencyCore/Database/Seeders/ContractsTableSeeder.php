<?php

namespace Modules\AgencyCore\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContract\Entities\ContractType;
use Modules\AgencyContractDate\Entities\ContractDate;
use Modules\AgencyContractDate\Entities\ContractDateSet;
use Modules\AgencyContractDoc\Entities\ContractDoc;
use Modules\AgencyContractDoc\Entities\ContractDocSet;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\Client;

class ContractsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();


        Client::inRandomOrder()->limit(50)
              ->get()
              ->each(function(Client $client) {

                  $applicant = factory(Applicant::class)->create();

                  if($applicant->current_country === 'Hong Kong') {
                      $contract_type_id = ContractType::where('label',
                                                              'Local')->first()->id;
                  } else {
                      $contract_type_id = ContractType::where('label',
                                                              'Overseas')->first()->id;
                  }


                  $contact = factory(Contract::class)->create([
                                                                  'client_id'        => $client->id,
                                                                  'contract_type_id' => $contract_type_id,
                                                                  'applicant_id'     => $applicant->id,
                                                                  'address_id'       => $client->addresses()
                                                                                               ->first()->id,
                                                              ]);

                  for($i = 0; $i < rand(5,
                                        8); $i++) {

                      $contact->residents()->attach(factory(Client::class)->create()->id);
                  }

              });

    }
}
