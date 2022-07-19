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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->timestamps();
            $table->softDeletes();
			$table->string('restaurant_name');
			$table->string('unique_code')->unique();
			$table->string('gst_number');
			$table->string('primary_contact_no', 11)->unique();
			$table->string('secondary_contact_no');
			$table->string('address');
			$table->boolean('is_razorpay_allowed');
			$table->string('is_cred_allowed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
