<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contents',
            function(Blueprint $table) {
                $table->id();
                $table->string('language');
                $table->string('key');
                $table->text('content')->nullable();

                $table->unsignedBigInteger('page_id')->nullable();
                $table->foreign('page_id')
                      ->references('id')
                      ->on('pages')
                      ->onDelete('cascade');

                $table->timestamps();

                $table->unique(['page_id', 'language', 'key']);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contents');
    }
}
