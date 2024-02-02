<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stripe_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('fname');
            $table->string('lname');
            $table->integer('city_id');
            $table->integer('zip');
            $table->string('company');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('status');

            $table->integer('country_id');
            $table->string('message');
            $table->integer('ship_check');
            $table->string('ship_fname');
            $table->string('ship_lname');
            $table->integer('ship_country_id');
            $table->integer('ship_city_id');
            $table->integer('ship_zip');
            $table->string('ship_company');
            $table->string('ship_email');
            $table->string('ship_phone');
            $table->string('ship_address');
            $table->integer('charge');
            $table->integer('payment');
            $table->integer('discount');
            $table->integer('sub_total');
            $table->integer('total');
            $table->integer('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripe_orders');
    }
};
