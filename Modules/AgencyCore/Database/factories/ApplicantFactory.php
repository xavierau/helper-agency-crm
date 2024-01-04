<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use Faker\Generator as Faker;
use Modules\AgencyCore\Entities\Applicant;

$factory->define(Applicant::class,
    function (Faker $faker) {
        $gender = ['male', 'female'][rand(0,
            1)];
        $nationality = ['Indonesian', 'Filipino', 'Cambodian'][rand(0,
            2)];

        $languageLevel = ['Native', 'Good', 'Fair', 'Poor'];

        $ageMultiplier = rand(20,
            45);
        $birthDate = Carbon::now()
            ->addDays(-($ageMultiplier * 365 - rand(0,
                    365)));

        $father_age = $ageMultiplier + rand(18,
                40);

        $mother_age = $father_age - rand(-10,
                15);

        $thumbnail = sprintf("https://randomuser.me/api/portraits/%s/%s.jpg",
            $gender === 'male' ? 'men' : 'women',
            rand(0,
                99));

        $issueDate = now()->addDays(-rand(365,
            365 * 5));

        return [
            'surname'              => $faker->lastName,
            'middle_name'          => '',
            'given_name'           => $faker->firstName,
            'hk_code'              => $faker->uuid,
            'pt_code'              => $faker->uuid,
            'english'              => $languageLevel[rand(0,
                3)],
            'cantonese'            => $languageLevel[rand(0,
                3)],
            'mandarin'             => $languageLevel[rand(0,
                3)],
            'religion'             => 'CATHOLIC',
            'date_of_birth'        => $birthDate,
            'passport_number'      => Str::random(1) .
                rand(10000000000,
                    99999999999),
            'passport_issued_date' => $issueDate,
            'sex'                  => $gender,
            'nationality'          => $nationality,
            'marital_status'       => ['single', 'married'][rand(0,
                1)],
            'height'               => rand(145,
                180),
            'weight'               => rand(45,
                60),
            'father_name'          => $faker->name('male'),
            'father_age'           => $father_age,
            'father_occupation'    => 'retired',
            'mother_name'          => $faker->name('female'),
            'mother_age'           => $mother_age,
            'mother_occupation'    => 'retired',
            'spouse_age'           => rand(25,
                40),
            'spouse_name'          => $faker->name,
            'spouse_occupation'    => $faker->jobTitle,
            'status'               => rand(0,
                10) < 7 ? 'active' :
                'inactive',
            'is_approved'          => rand(0,
                    10) < 7,
//            'thumbnail'            => $thumbnail,
//            'current_country'      => [
//                                          'Hong Kong',
//                                          'Taiwan',
//                                          'Singapore',
//                                      ][rand(0,
//                2)],

            'emergency_contact_name'     => $faker->name,
            'emergency_contact_relation' => ['father', 'mother'][rand(0,
                1)],
            'emergency_contact_number'   => $faker->phoneNumber,

        ];
    });
