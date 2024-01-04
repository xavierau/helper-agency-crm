<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('client_contract',
            function(Blueprint $table) {
                $table->unsignedBigInteger('client_id');
                $table->foreign('client_id')->references('id')->on('clients')
                      ->onDelete('cascade');
                $table->unsignedBigInteger('contract_id');
                $table->foreign('contract_id')->references('id')->on('contracts')
                      ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('client_contract');
    }
}
