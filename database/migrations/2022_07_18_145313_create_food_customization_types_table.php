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
        Schema::create('food_customization_types', function (Blueprint $table) {
            

            $table->increments('id');
			
			$table->Integer('food_item_id')->unsigned();
            $table->foreign('food_item_id')->references('id')->on('food_items');

			$table->string('name');
			$table->smallInteger('min_selection_count');
			$table->integer('max_selection_count');
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
        Schema::dropIfExists('food_customization_types');
    }
};
