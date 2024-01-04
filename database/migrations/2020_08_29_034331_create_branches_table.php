<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('branches',
            function(Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
        Schema::create('branch_user',
            function(Blueprint $table) {
                $table->unsignedBigInteger('branch_id');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');

                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('branch_user');
        Schema::dropIfExists('branches');
    }
}
