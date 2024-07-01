<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('course_id');
            $table->dropColumn('class_id');
        });

        Schema::create('student_classes', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('course_id');
            $table->string('class_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('course_id')->nullable();
            $table->string('class_id')->nullable();
        });

        Schema::dropIfExists('student_classes');
    }
}
