<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'applicant_experiences',
            function (Blueprint $table) {
                $table->id();
                $table->string('location')->nullable();
                $table->string('region')->nullable();
                $table->string('position')->nullable();
                $table->date('from')->nullable();
                $table->date('to')->nullable();
                $table->integer('house_size')->nullable();
                $table->integer('number_of_adult')->nullable();
                $table->string('age_of_adult')->nullable();
                $table->integer('number_of_children')->nullable();
                $table->string('age_of_children')->nullable();
                $table->integer('number_of_elderly')->nullable();
                $table->string('age_of_elderly')->nullable();
                $table->text('description')->nullable();
                $table->text('reason')->nullable();
                $table->enum(
                    'status',
                    ['finished', 'terminated']
                )->default('finished');

                $table->unsignedBigInteger('applicant_id');
                $table->foreign('applicant_id')->references('id')->on('applicants');
                $table->timestamps();
            }
        );

        Schema::create(
            'applicant_experience_domestic_duty',
            function (Blueprint $table) {
                $table->unsignedBigInteger('experience_id');
                $table->foreign('experience_id')
                    ->references('id')
                    ->on('applicant_experiences')
                    ->onDelete('cascade');

                $table->unsignedBigInteger('duty_id');
                $table->foreign('duty_id')
                    ->references('id')
                    ->on('domestic_duties')
                    ->onDelete('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicant_experiences');
    }
}
