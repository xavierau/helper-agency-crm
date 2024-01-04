<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractDocValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contract_doc_values',
            function(Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('contract_doc_id');
                $table->foreign('contract_doc_id')->references('id')->on('contract_docs')
                      ->onDelete('cascade');
                $table->unsignedBigInteger('contract_id');
                $table->foreign('contract_id')->references('id')->on('contracts')
                      ->onDelete('cascade');
                $table->string('value')->nullable();
                $table->string('mime_type')->nullable();

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contract_doc_values');
    }
}
