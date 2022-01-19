<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoperNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoper_notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_id')->nullable();
            $table->string('data')->nullable();
            $table->string('url')->nullable();
            $table->integer('status')->nullable()->default('1');
            $table->integer('seen')->nullable()->default('1');
            $table->timestamp('time')->nullable();
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
        Schema::dropIfExists('shoper_notifications');
    }
}
