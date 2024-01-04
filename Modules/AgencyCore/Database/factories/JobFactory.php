<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use Faker\Generator as Faker;
use Modules\AgencyCore\Entities\Account;
use Modules\AgencyCore\Entities\Client;
use Modules\AgencyCore\Entities\Job;
use Modules\AgencyCore\Entities\Requirement;

$factory->define(class: Job::class,
    attributes: function (Faker $faker) {
        return [
            'service_type'       => rand(0, 100),
            'client_id'       => fn()=>factory(Client::class)->create()->id,
            'nationality'=>'Hong Kong',
            'status'             => ['pending', 'cancelled', 'confirmed', 'lost'][rand(0, 3)],
            'note'               => $faker->paragraph,
            'type'               => 'normal',
            'services'           => json_encode(['note1'=>'this is note i']),
        ];
    });
