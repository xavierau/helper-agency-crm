<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('special_requests',
            function(Blueprint $table) {
                $table->id('id');
                $table->string('content');
                $table->unsignedBigInteger('contract_id');
                $table->foreign('contract_id')->references('id')->on('contracts')
                      ->onDelete('cascade');

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('special_requests');
    }
}
