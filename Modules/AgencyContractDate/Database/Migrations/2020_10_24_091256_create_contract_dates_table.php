<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contract_dates',
            function(Blueprint $table) {
                $table->id();
                $table->string('label');
                $table->string('group');
                $table->timestamps();
            });
        Schema::create('contract_date_set',
            function(Blueprint $table) {
                $table->id('id');
                $table->unsignedBigInteger('contract_type_id');
                $table->foreign('contract_type_id')->references('id')->on('contract_types')
                      ->onDelete('cascade');
                $table->unsignedBigInteger('contract_date_id');
                $table->foreign('contract_date_id')->references('id')->on('contract_dates')
                      ->onDelete('cascade');
                $table->unsignedInteger('order')->nullable();
                $table->boolean('is_required')->default(false);
                $table->timestamps();
            });
        Schema::create('contract_date_values',
            function(Blueprint $table) {
                $table->id('id');
                $table->unsignedBigInteger('contract_id');
                $table->foreign('contract_id')->references('id')->on('contracts')
                      ->onDelete('cascade');
                $table->unsignedBigInteger('contract_date_id');
                $table->foreign('contract_date_id')->references('id')->on('contract_dates')
                      ->onDelete('cascade');
                $table->date('value')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contract_date_values');
        Schema::dropIfExists('contract_date_set');
        Schema::dropIfExists('contract_dates');
    }
}
