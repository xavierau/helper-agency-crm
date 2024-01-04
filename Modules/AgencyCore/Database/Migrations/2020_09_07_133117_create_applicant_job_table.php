<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_job',
            function (Blueprint $table) {
                $table->unsignedBigInteger('applicant_id');
                $table->foreign('applicant_id')->references('id')->on('applicants')
                    ->onDelete('cascade');

                $table->unsignedBigInteger('job_id');
                $table->foreign('job_id')->references('id')->on('jobs')
                    ->onDelete('cascade');

                $table->string('channel')->nullable();

                $table->string('status');

                $table->text('note')->nullable();

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
        Schema::dropIfExists('applicant_job');
    }
}
