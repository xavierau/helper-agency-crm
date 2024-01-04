<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use Faker\Generator as Faker;
use Modules\AgencyContract\Entities\ContractType;
use Modules\AgencyCore\Entities\Account;
use Modules\AgencyCore\Entities\Client;

$factory->define(class: ContractType::class,
    attributes: function (Faker $faker) {
        return [
            'label' => ['Local', 'Overseas'][rand(0, 1)],
        ];
    });
