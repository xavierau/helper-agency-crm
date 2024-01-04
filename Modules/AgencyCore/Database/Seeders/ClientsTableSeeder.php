<?php

namespace Modules\AgencyCore\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\AgencyCore\Entities\Address;
use Modules\AgencyCore\Entities\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        $numberOfClients = 150;

        $items = factory(Client::class,
                         $numberOfClients)->create()->each(function(Client $client) {
            factory(Address::class)->create([
                                                'owner_type' => get_class($client),
                                                'owner_id'   => $client->id,
                                            ]);
        });

    }
}
