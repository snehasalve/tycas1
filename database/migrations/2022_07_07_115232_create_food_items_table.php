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
        Schema::create('food_items', function (Blueprint $table) {
           $table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients');

			$table->string('name');
			$table->string('image');

			$table->string('base_price')->nullable();

			$table->integer('category_id')->nullable()->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');

			$table->enum('item_status', array('outOfStock', 'available', 'willTakeTime'));
			$table->boolean('is_drink')->default(0);
			$table->boolean('is_hard_drink')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_items');
    }
};
