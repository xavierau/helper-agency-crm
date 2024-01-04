<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantExperienceDomesticDutyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
//        Schema::create('applicant_experience_domestic_duty',
//            function(Blueprint $table) {
//                $table->unsignedBigInteger('applicant_experience_id');
//                $table->foreign('applicant_experience_id')
//                      ->references('id')
//                      ->on('applicant_experiences')
//                      ->onDelete('cascade');
//
//                $table->unsignedBigInteger('domestic_duty_id');
//                $table->foreign('domestic_duty_id')
//                      ->references('id')
//                      ->on('domestic_duties')
//                      ->onDelete('cascade');
//            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('applicant_experience_domestic_duty');
    }
}
