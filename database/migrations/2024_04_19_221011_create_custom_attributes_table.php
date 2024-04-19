<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// users
        Schema::create('custom_properties', function (Blueprint $table) {
            $table->id();
            $table->string('name', 15);
            $table->string('unique_name', 30)->unique();
            $table->string('type', 10);
			$table->boolean('agency_enabled')->default(false)->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_properties');
    }
}