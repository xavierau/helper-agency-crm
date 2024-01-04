<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses',
            function (Blueprint $table) {
                $table->id();
                $table->string('address_1')->nullable();
                $table->string('address_2')->nullable();
                $table->string('address_3')->nullable();
                $table->string('state')->nullable();
                $table->string('country')->nullable();
                $table->string('postal_code')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });

        Schema::create('address_owners',
            function (Blueprint $table) {

                $table->unsignedBigInteger('address_id');

                $table->morphs('owner');

                $table->primary(['owner_type', 'owner_id', 'address_id']);

            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_owners');
        Schema::dropIfExists('addresses');
    }
}
