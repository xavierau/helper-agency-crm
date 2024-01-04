<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();

            //region: Personal Info
            $table->string('hk_code')->unique()->index();
            $table->string('pt_code')->unique();

            $table->string('location')->nullable();
            $table->string('surname')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('given_name')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->unsignedInteger('weight')->nullable();
            $table->string('nationality')->nullable();
            $table->string('sex')->default('female');
            $table->string('marital_status')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('horoscope')->nullable();
            $table->string('religion')->nullable();

            $table->text('address')->nullable();
            $table->string('mobile')->nullable();

            $table->boolean('afraid_of_dog')->default(false);
            $table->boolean('eat_pork')->default(true);
            $table->boolean('smoke_and_drink')->default(false);
            //endregion:

            $table->date("date_of_release")->nullable();

            $table->schemalessAttributes('family');
            $table->schemalessAttributes('education');
            $table->schemalessAttributes('emergency');
            $table->schemalessAttributes('personal_document');
            $table->schemalessAttributes('preference');
            $table->schemalessAttributes('holiday_arrangement');
            $table->schemalessAttributes('questions');


            //region: Document
//            $table->string('hkid')->nullable();
//            $table->string('passport_number')->nullable();
//            $table->string('place_of_issue')->nullable();
//            $table->date('passport_issued_date')->nullable();
//            $table->date('passport_expiry_date')->nullable();
            //endregion

            //region: Language
            $table->string('english')->nullable();
            $table->string('mandarin')->nullable();
            $table->string('cantonese')->nullable();
            $table->string('other_language')->nullable();
            //endregion

            //region: Education
//            $table->string('highest_education')->nullable();
//            $table->string('graduation_year')->nullable();
//            $table->string('major')->nullable();
//            $table->string('school_name')->nullable();
            //endregion

            //region: Status flag
            $table->string('status')->default('pending');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_approved')->default(true);
            //endregion

            //region: Emergency info
//            $table->string('emergency_contact_name')->nullable();
//            $table->string('emergency_contact_relation')->nullable();
//            $table->string('emergency_contact_number')->nullable();
            //endregion

            $table->string('random_identifier', 8)->nullable();

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers');

            $table->timestamps();

        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
