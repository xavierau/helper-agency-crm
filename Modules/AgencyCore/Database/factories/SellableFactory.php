<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\AgencyCore\Entities\Sellable;

$factory->define(Sellable::class,
    function(Faker $faker) {
        return [
            'name'  => $faker->words(3,
                                     true),
            'price' => rand(1000,
                            10000),

        ];
    });
