<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('shop_name')->nullable();
            $table->string('c_name')->nullable();
            $table->string('c_email')->nullable();
            $table->string('c_city')->nullable();
            $table->string('c_area')->nullable();
            $table->string('c_address')->nullable();
            $table->string('c_phone')->nullable();
            $table->string('c_extra_phone')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('total')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('after_discount')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('tax')->nullable();
            $table->string('shipping_cost')->nullable();
            $table->string('order_id')->nullable();
            $table->integer('status')->nullable()->default('0');
            $table->string('date')->nullable();
            $table->string('cancle_date')->nullable();
            $table->string('shipped_date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
