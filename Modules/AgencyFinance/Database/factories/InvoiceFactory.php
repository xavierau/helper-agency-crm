<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\AgencyFinance\Entities\Invoice;

$factory->define(Invoice::class,
    function(Faker $faker) {
        return [
            'client_id' => function() {
                return factory(\Modules\AgencyCore\Entities\Client::class)->create()->id;
            },
        ];
    });
