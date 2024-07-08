<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsRegsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms_mems', function (Blueprint $table) {
            $table->id();
            
            $table->string('user_id');
            $table->string('created_at');

            $table->string('name'); //
            $table->string('spouse_name')->nullable(); //
            $table->string('mailing_address')->nullable(); //

            $table->string('tel_no'); //
            $table->string('email'); //

            $table->string('membership_for'); //

            $table->string('fee_paid')->nullable(); //
            $table->string('fee_paid_ref_id')->nullable(); //

            $table->string('volunteer_program')->nullable(); //
            $table->string('volunteer_school')->nullable(); //
            $table->string('volunteer_office')->nullable(); //
            $table->string('volunteer_library')->nullable(); //

            $table->string('introduced_by')->nullable(); //
            $table->string('introduced_by_name')->nullable(); //
            
            $table->string('approved_by')->nullable(); //
            $table->string('approved_by_name')->nullable(); //
        });

        Schema::create('forms_regs', function (Blueprint $table) {
            $table->id();
            
            $table->string('user_id');
            $table->string('created_at');

            $table->string('receipt_fee')->nullable();
            $table->string('receipt_membership')->nullable();
            $table->string('supplies_provided')->nullable();

            $table->string('first_name')->nullable(); //
            $table->string('last_name'); //

            $table->string('date_of_birth')->nullable(); //
            $table->string('tel_no')->nullable(); //
            $table->string('email'); //

            $table->string('address')->nullable(); //
            $table->string('city')->nullable(); //
            $table->string('postal_code')->nullable(); //

            $table->string('father_name')->nullable(); //
            $table->string('mother_name')->nullable(); //

            $table->string('know_hindi')->nullable(); //
            $table->string('hindi_speak')->nullable(); //
            $table->string('hindi_read')->nullable(); //
            $table->string('hindi_write')->nullable(); //

            $table->string('student_before')->nullable(); //

            $table->string('student_before_year')->nullable(); //
            $table->string('student_before_level')->nullable(); //

            $table->string('family_language')->nullable(); //

            $table->string('why_need_to_learn')->nullable(); //

            $table->string('membership_for')->nullable(); //
            $table->string('fee_paid')->nullable(); //
            $table->string('fee_paid_ref_id')->nullable(); //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms_mems');
        Schema::dropIfExists('forms_regs');
    }
}
