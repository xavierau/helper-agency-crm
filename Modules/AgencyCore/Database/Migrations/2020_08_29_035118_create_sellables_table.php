<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sellables',
            function(Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->float('price');
                $table->float('inventory')->default(1);
                $table->boolean('is_active')->default(true);
                $table->boolean('editable')->default(false);
                $table->boolean('track_inventory')->default(false);
                $table->text('description')->nullable();

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sellables');
    }
}
