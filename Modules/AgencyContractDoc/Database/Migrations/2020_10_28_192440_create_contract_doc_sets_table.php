<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractDocSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_doc_sets',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('contract_doc_id');
                $table->foreign('contract_doc_id')->references('id')->on('contract_docs')
                    ->onDelete('cascade');
                $table->unsignedBigInteger('contract_type_id');
                $table->foreign('contract_type_id')->references('id')->on('contract_types')
                    ->onDelete('cascade');
                $table->boolean('is_required')->default(false);
                $table->unsignedInteger('order')->default(0);

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
        Schema::dropIfExists('contract_doc_sets');
    }
}
