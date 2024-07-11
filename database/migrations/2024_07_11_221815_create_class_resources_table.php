<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_resources', function (Blueprint $table) {
            $table->id();
            $table->string('class_id');
            $table->string('type');
            $table->string('file_path')->nullable();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_resources');
    }
}
