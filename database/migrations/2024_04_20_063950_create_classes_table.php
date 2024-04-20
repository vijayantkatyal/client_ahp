<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('course_id');

            $table->string('assigned_member_id')->nullable();
            $table->string('added_on');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('course_id')->nullable();
            $table->string('class_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('course_id');
            $table->dropColumn('class_id');
        });
    }
}
