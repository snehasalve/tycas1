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
        Schema::create('food_size_options', function (Blueprint $table) {
            $table->increments('id');
			
			
			$table->string('size');
			$table->string('price');

            $table->Integer('food_item_id')->unsigned();
            $table->foreign('food_item_id')->references('id')->on('food_items');

            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_size_options');
    }
};
