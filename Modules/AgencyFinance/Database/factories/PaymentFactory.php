<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\AgencyFinance\Entities\Invoice;
use Modules\AgencyFinance\Entities\Payment;

$factory->define(Payment::class,
    function(Faker $faker) {
        return [
            'invoice_id' => function() {
                return factory(Invoice::class)->create()->id;
            },
            'amount'     => rand(10,
                                 10000),
            'type'       => 'cheque',
            'note'       => $faker->paragraph,
        ];
    });
