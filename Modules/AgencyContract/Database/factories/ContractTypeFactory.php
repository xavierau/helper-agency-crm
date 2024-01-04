<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\AgencyContract\Entities\ContractType;

$factory->define(ContractType::class,
    function(Faker $faker) {
        return [
            'label' => $faker->word,
        ];
    });
