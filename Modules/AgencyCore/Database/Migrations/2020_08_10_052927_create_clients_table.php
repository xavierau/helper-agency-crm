<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients',
            function (Blueprint $table) {
                $table->id();
                $table->string('prefix')->nullable();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('chinese_first_name')->nullable();
                $table->string('chinese_last_name')->nullable();
                $table->string('occupation')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->string('place_of_birth')->nullable();
                $table->boolean('is_male')->default(true);
                $table->string('email')->nullable();
                $table->string('tel')->nullable();
                $table->string('mobile')->nullable();
                $table->string('company_name')->nullable();
                $table->string('marital_status')->nullable();
                $table->string('hk_id')->nullable();
                $table->string('nationality')->nullable();
                $table->string('client_number')->nullable()->unique();
                $table->boolean('is_primary')->default(true);
                $table->boolean('require_constant_care')->default(false);
                $table->integer('gid')->nullable();
                $table->unsignedBigInteger('account_id')->nullable();
                $table->foreign('account_id')->references('id')->on('accounts');

                $table->timestamps();
            });

        Schema::create('client_relation',
            function (Blueprint $table) {
                $table->unsignedBigInteger('principle_id');
                $table->foreign('principle_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');
                $table->unsignedBigInteger('other_id');
                $table->foreign('other_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');
                $table->string('relation')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_relation');
        Schema::dropIfExists('clients');
    }
}
