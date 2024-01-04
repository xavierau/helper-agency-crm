<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('invoice_items',
            function(Blueprint $table) {
                $table->id();
                $table->float('qty')->default(1);
                $table->float('price')->default(1);
                $table->float('discount')->default(0);
                $table->text('note')->nullable();
                $table->unsignedBigInteger('invoice_id');
                $table->foreign('invoice_id')->references('id')->on('invoices')
                      ->onDelete('cascade');
                $table->unsignedBigInteger('sellable_id');
                $table->foreign('sellable_id')->references('id')->on('sellables')
                      ->onDelete('cascade');
                $table->unsignedBigInteger('variant_id')->nullable();
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
        Schema::dropIfExists('invoice_items');
    }
}
