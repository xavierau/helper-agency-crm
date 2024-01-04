<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use Faker\Generator as Faker;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContract\Entities\ContractType;
use Modules\AgencyCore\Entities\Applicant;

$factory->define(Contract::class,
    function(Faker $faker) {

        $startDate = Carbon::now()->addDays(-(rand(0,
                                                   365 * 2)));
        $end_date = $startDate->clone()->addDays(365 * 2);

        $accommodationType = [
                                 'alone',
                                 'share with children',
                                 'share with elderly',
                             ][rand(0,
                                    2)];
        $accommodationValue = null;
        switch($accommodationType) {
            case 'share with children':
                $accommodationValue = rand(0,
                                           7);
                break;
            case 'share with elderly':
                $accommodationValue = rand(65,
                                           85);
                break;
            default:
                $accommodationValue = rand(80,
                                           170);

        }


        return [
            'contract_number'  => $faker->uuid,
            'start_date'       => $startDate,
            'end_date'         => $end_date,
            'internal_code'    => $faker->uuid,
            'salary'           => 4630,
            'food_subsidy'     => 1121,
            'applicant_id'     => function() {
                return factory(Applicant::class)->create()->id;
            },
            'contract_type_id' => function() {
                return factory(ContractType::class)->create()->id;
            },
            //            'number_of_bedrooms'  => rand(0,
            //                                          5),
            //            'residence_area'      => rand(500,
            //                                          2500),
            //            'dayoff_arrangement'  => [
            //                                         'Every Sunday Holiday',
            //                                         'Fix Weekday Holiday',
            //                                         'Arrangement by Employer',
            //                                         'Money in lieu of Holiday',
            //                                     ][rand(0,
            //                                            3)],
            //            'accommodation_type'  => $accommodationType,
            //            'accommodation_value' => $accommodationValue,
        ];
    });
