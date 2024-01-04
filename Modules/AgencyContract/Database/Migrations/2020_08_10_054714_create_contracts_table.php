<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts',
            function (Blueprint $table) {

                $table->id();
                $table->string('contract_number')->unique();
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->string('internal_code');

                $table->date('expected_arrival_date')->nullable();
                $table->integer('salary');
                $table->integer('food_subsidy');
                $table->string('special_request_1')->nullable();
                $table->string('special_request_2')->nullable();;
                $table->string('special_request_3')->nullable();;

                $table->unsignedBigInteger('client_id');
                $table->foreign('client_id')
                    ->references('id')
                    ->on('clients');

                $table->unsignedBigInteger('address_id')->nullable();
                $table->foreign('address_id')
                    ->references('id')
                    ->on('addresses');

                $table->unsignedBigInteger('contract_type_id');
                $table->foreign('contract_type_id')
                    ->references('id')
                    ->on('contract_types')
                    ->onDelete('cascade');

                $table->timestamps();
            });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
