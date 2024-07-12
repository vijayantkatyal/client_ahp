<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_assignments', function (Blueprint $table) {
            $table->id();
            $table->string('class_id');

            $table->string('type'); // type assignment, home work
            $table->string('file_type'); // file type note, file
            
            $table->string('name');
            $table->string('file')->nullable(); // file attached
            $table->longText('note')->nullable(); // note
            $table->string('max_marks')->nullable(); // max marks

            $table->boolean('published')->nullable();


            $table->string('created_by_id');
        });

        Schema::create('student_assignments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('class_id');
            $table->string('assignment_id');

            $table->string('file')->nullable();
            $table->longText('note')->nullable();

            $table->string('marks_obtained')->nullable();
            $table->boolean('accepted')->nullable();
        });

        Schema::create('student_assignment_thread', function (Blueprint $table) {
            $table->id();
            $table->string('student_assignment_id');

            $table->string('user_id');
            $table->string('class_id');
            $table->longText('message');

            $table->string('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_assignments');
        Schema::dropIfExists('student_assignments');
        Schema::dropIfExists('student_assignment_thread');
    }
}
