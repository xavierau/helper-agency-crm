<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('invoices',
            function(Blueprint $table) {
                $table->id();
                $table->string('invoice_number')->unique();
                $table->date('due_date');
                $table->float('discount')->default(0);
                $table->text('note')->nullable();
                $table->string('status')->default('active');

                $table->unsignedBigInteger('contract_id')->nullable();
                $table->foreign('contract_id')
                      ->references('id')
                      ->on('contracts')
                      ->onDelete('cascade');
                $table->unsignedBigInteger('client_id');
                $table->foreign('client_id')
                      ->references('id')
                      ->on('clients')
                      ->onDelete('cascade');
                $table->unsignedBigInteger('invoice_id')->nullable();
                $table->foreign('invoice_id')
                      ->references('id')
                      ->on('invoices')
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
        Schema::dropIfExists('invoices');
    }
}
