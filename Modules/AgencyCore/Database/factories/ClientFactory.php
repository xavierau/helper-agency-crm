<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use Faker\Generator as Faker;
use Modules\AgencyCore\Entities\Account;
use Modules\AgencyCore\Entities\Client;

$factory->define(Client::class,
    function(Faker $faker) {

        $randIndex = rand(0,
                          2);
        $prefix = ['Mr', 'Ms', 'Mrs'][$randIndex];

        return [
            'prefix'             => $prefix,
            'first_name'         => $faker->firstName($randIndex > 0 ? 'female': 'male'),
            'last_name'          => $faker->lastName,
            'chinese_first_name' => '大文',
            'chinese_last_name'  => '陳',
            'client_number'      => $faker->uuid,
            'is_male'            => (bool)rand(0,
                                               1),
            'tel'                => rand(20000000,
                                         29999999),
            'email'              => $faker->email,
            'nationality'        => $faker->country,
            'hk_id'              => sprintf("%s%s(%s)",
                                            Str::random(1),
                                            rand(100000,
                                                 999999),
                                            rand(1,
                                                 9)),
            'occupation'         => $faker->jobTitle,
            'date_of_birth'      => Carbon::now()->addDays(-rand(20 * 365,
                                                                 50 * 365)),
            'place_of_birth'     => $faker->country,
            'marital_status'     => ['single', 'married'][rand(0,
                                                               1)],
            'account_id'         => fn() => factory(Account::class)->create()->id,
            'mobile'             => rand(90000000,
                                         99999999),
        ];
    });
