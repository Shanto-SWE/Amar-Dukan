<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name')->nullable();
            $table->string('shop_owner_name')->nullable();
            $table->string('shop_owner_email')->nullable();
            $table->string('shop_owner_photo')->nullable();
            $table->string('shop_slug')->nullable();
            $table->string('shop_city')->nullable();
            $table->string('shop_area')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->string('district_name')->nullable();
            $table->string('shop_phone')->nullable();
            $table->string('shop_another_phone')->nullable();
            $table->string('shop_photo')->nullable();
            $table->string('open_time')->nullable();
            $table->string('close_time')->nullable();
            $table->integer('status')->nullable()->default('0');
            $table->string('password')->nullable();
            $table->string('registration_date')->nullable();
            $table->foreign('district_id')->references('id')->on('districts')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('shops');
    }
}
