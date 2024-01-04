<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('requirements',
            function(Blueprint $table) {
                $table->id();
                $table->date('expected_arrival_date')->nullable();
                $table->unsignedInteger('house_size')->nullable();
                $table->unsignedInteger('number_of_rooms')->nullable();
                $table->unsignedInteger('garden_size')->nullable();
                $table->unsignedInteger('number_of_cars')->nullable();
                $table->unsignedInteger('number_of_expecting_babies')->nullable();
                $table->unsignedInteger('number_of_kids')->nullable();
                $table->unsignedInteger('number_of_young_adults')->nullable();
                $table->json('age_of_kids')->nullable();
                $table->json('age_of_young_adults')->nullable();
                $table->json('age_of_adults')->nullable();
                $table->json('age_of_elders')->nullable();
                $table->unsignedInteger('number_of_adults')->nullable();
                $table->unsignedInteger('number_of_elders')->nullable();
                $table->unsignedInteger('disabled_personnel')->nullable();
                $table->json('pets')->nullable();
                $table->string('dayoff_arrangement')->nullable();
                $table->string('accommodation_type')->nullable();
                $table->string('accommodation_value')->nullable();
                $table->text('special_duties')->nullable();
                $table->text('note')->nullable();

                $table->unsignedBigInteger('contract_id')->nullable();
                $table->foreign('contract_id')
                      ->references('id')
                      ->on('contracts')
                      ->onDelete('cascade');

                $table->unsignedBigInteger('job_id')->nullable();
                $table->foreign('job_id')
                      ->references('id')
                      ->on('jobs')
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
        Schema::dropIfExists('requirements');
    }
}
