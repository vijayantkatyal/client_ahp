<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_school', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('school_activity');
            $table->string('no_of_classes');
            $table->string('activity')->nullable();
        });

        Schema::create('calendar_director', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('school_activity');
            $table->string('no_of_classes');
            $table->string('director_on_duty')->nullable();
            $table->string('activity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_school');
        Schema::dropIfExists('calendar_director');
    }
}
