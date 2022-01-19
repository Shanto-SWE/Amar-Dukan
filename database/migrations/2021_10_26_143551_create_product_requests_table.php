<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_id')->nullable();
            $table->integer('customer_id')->nullable();;
            $table->string('product_name')->nullable();
            $table->string('product_origin')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('product_quantity')->nullable();
            $table->text('product_description')->nullable();
            $table->string('product_photo')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('delivery_area')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('delivery_date')->nullable();
            $table->integer('request_id')->nullable();
            $table->string('subtotal_price')->nullable();
            $table->string('total_price')->nullable();
            $table->string('shipping_cost')->nullable();
            $table->integer('status')->nullable()->default('0');
            $table->string('item_status')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('product_requests');
    }
}
