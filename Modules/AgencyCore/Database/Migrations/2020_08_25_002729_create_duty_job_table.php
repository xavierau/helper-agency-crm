<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDutyJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('domestic_duty_job',
            function(Blueprint $table) {
                $table->unsignedBigInteger('job_id');
                $table->foreign('job_id')
                      ->references('id')
                      ->on('jobs')
                      ->onDelete('cascade');
                $table->unsignedBigInteger('domestic_duty_id');
                $table->foreign('domestic_duty_id')
                      ->references('id')
                      ->on('domestic_duties')
                      ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('domestic_duty_job');
    }
}
