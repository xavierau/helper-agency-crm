<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use Faker\Generator as Faker;
use Modules\AgencyCore\Entities\Account;
use Modules\AgencyCore\Entities\Client;
use Modules\AgencyCore\Entities\Requirement;

$factory->define(class: Requirement::class,
    attributes: function (Faker $faker) {
        return [
            'expected_arrival_date'      =>now()->addDays(rand(14, 60)),
            'house_size'                 =>rand(400, 5000),
            'number_of_rooms'            =>rand(2, 5),
            'garden_size'                =>rand(0, 3000),
            'number_of_cars'             =>rand(1, 5),
            'number_of_expecting_babies' =>rand(0, 2),
            'number_of_kids'             =>rand(0, 5),
            'number_of_young_adults'     =>rand(0, 5),
            'number_of_adults'           =>rand(1, 3),
            'number_of_elders'           =>rand(0, 3),
            'disabled_personnel'         =>rand(0, 2),
            'pets'                       =>rand(1, 5),
            'dayoff_arrangement'         =>'customize',
            'accommodation_type'         =>['shared', 'single'][rand(0,1)],
            'accommodation_value'        =>0,
        ];
    });
