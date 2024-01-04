<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\AgencyFinance\Enums\CreditNoteStatus;

class CreateCreditNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('credit_notes',
            function(Blueprint $table) {
                $table->id();
                $table->string('credit_note_number')->unique();
                $table->unsignedBigInteger('from_contract_id');
                $table->unsignedBigInteger('to_contract_id')->nullable();
                $table->unsignedFloat('amount')->default(0.0);
                $table->date('expired_date');
                $table->string('status')
                      ->default(CreditNoteStatus::PENDING());

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('credit_notes');
    }
}
