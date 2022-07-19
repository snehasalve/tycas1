<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_customization_options', function (Blueprint $table) {
            $table->increments('id');
			
			
			$table->string('name');
			$table->string('price');

            $table->integer('customization_type_id')->unsigned();
            $table->foreign('customization_type_id')->references('id')->on('food_customization_types');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_customization_options');
    }
};
