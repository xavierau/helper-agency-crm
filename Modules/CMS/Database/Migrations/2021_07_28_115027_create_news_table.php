<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('news',
            function(Blueprint $table) {
                $table->id();
                $table->text('title');
                $table->text('title_chi')->nullable();
                $table->text('summary')->nullable();
                $table->text('summary_chi')->nullable();
                $table->text('content')->nullable();
                $table->text('content_chi')->nullable();
                $table->boolean('is_active')->default(true);

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('news');
    }
}
