<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\AgencyCore\Entities\Supplier;

$factory->define(Supplier::class,
    function(Faker $faker) {
        return [
            'name' => $faker->company,
            'code' => $faker->uuid,
        ];
    });
