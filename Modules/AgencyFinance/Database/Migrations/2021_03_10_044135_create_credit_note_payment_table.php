<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditNotePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('credit_note_payment',
            function(Blueprint $table) {

                $table->unsignedBigInteger('credit_note_id');
                $table->foreign('credit_note_id')
                      ->references('id')
                      ->on('credit_notes')
                      ->onDelete('cascade');

                $table->unsignedBigInteger('payment_id');
                $table->foreign('payment_id')
                      ->references('id')
                      ->on('payments')
                      ->onDelete('cascade');

                $table->unsignedFloat('amount');

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('credit_note_payment');
    }
}
