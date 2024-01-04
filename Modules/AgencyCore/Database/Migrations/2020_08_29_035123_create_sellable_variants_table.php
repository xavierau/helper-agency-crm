<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellableVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sellable_variant',
            function(Blueprint $table) {
                $table->id();
                $table->float('price')->nullable();
                $table->float('inventory')->nullable();
                $table->boolean('is_active')->default(true);
                $table->text('description')->nullable();


                $table->unsignedBigInteger('sellable_id');
                $table->foreign('sellable_id')->references('id')->on('sellables')
                      ->onDelete('cascade');
                $table->unsignedBigInteger('variant_id');
                $table->foreign('variant_id')->references('id')->on('variants')
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
        Schema::dropIfExists('sellable_variant');
    }
}
