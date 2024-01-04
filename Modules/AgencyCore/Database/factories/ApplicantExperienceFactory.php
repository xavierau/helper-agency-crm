<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\ApplicantExperience;

$factory->define(ApplicantExperience::class,
    function(Faker $faker) {
        $duration = rand(1,
                         5);
        $before = rand(1,
                       5);
        $startOffset = -(365 * ($before + $duration));
        $endOffset = -(365 * $before);

        $countries = [
            'Taiwan',
            'Singapore',
            'Macau',
            'China',
            'Japan'
        ];

        return [
            'location'           => $countries[rand(0,count($countries)-1)],
            'position'           => ['Domestic Helper', 'Driver'][rand(0,
                                                                       10) < 8 ? 0: 1],
            'from'               => \Carbon\Carbon::now()->addDays($startOffset),
            'to'                 => \Carbon\Carbon::now()->addDays($endOffset),
            'house_size'         => rand(400,
                                         5000),
            'number_of_adult'    => ($n = rand(1,
                                               5)),
            'age_of_adult'       => $n > 0 ? rand(18,
                                                  50): 0,
            'number_of_children' => ($n_children = rand(1,
                                                        5)),
            'age_of_children'    => $n_children > 0 ? rand(3,
                                                           18): 0,
            'number_of_elderly'  => ($n_elderly = rand(0,
                                                       3)),
            'age_of_elderly'     => $n_elderly > 0 ? rand(65,
                                                          95): 0,
            'description'        => $faker->paragraph,
            'applicant_id'       => function() {
                return factory(Applicant::class)->create()->id;
            },

        ];
    });
