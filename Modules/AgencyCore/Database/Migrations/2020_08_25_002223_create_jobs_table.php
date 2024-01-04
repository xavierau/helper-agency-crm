<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs',
            function (Blueprint $table) {
                $table->id();
                $table->string('service_type');
                $table->string('type');
                $table->string('nationality')->nullable();
                $table->string('status')->default('active');
                $table->json('services')->nullable();
                $table->text('note')->nullable();

                $table->unsignedBigInteger('client_id');
                $table->foreign('client_id')->references('id')->on('clients');

//                $table->unsignedBigInteger('account_id');
                //                $table->foreign('account_id')->references('id')->on('accounts');

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
        Schema::dropIfExists('jobs');
    }
}
