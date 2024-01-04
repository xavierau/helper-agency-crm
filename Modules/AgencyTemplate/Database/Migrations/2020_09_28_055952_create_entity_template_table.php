<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('entity_template',
            function(Blueprint $table) {
                $table->id();
                $table->morphs('entity');
                $table->unsignedBigInteger('template_id');
                $table->foreign('template_id')->references('id')->on('templates')
                      ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('entity_template');
    }
}
