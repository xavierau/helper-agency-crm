<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\AgencyCore\Entities\Address;

$factory->define(Address::class,
    function(Faker $faker) {
        return [
            'address_1' => $faker->streetAddress,
            'country'   => 'Hong Kong',
        ];
    });
