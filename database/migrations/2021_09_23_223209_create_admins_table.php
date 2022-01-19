<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('position')->nullable();;
            $table->interger('role_admin')->nullable();
            $table->interger('district')->default(0)->nullable();
            $table->interger('shop')->default(0)->nullable();
            $table->interger('category')->default(0)->nullable();
            $table->interger('product')->default(0)->nullable();
            $table->interger('shipping_cost')->default(0)->nullable();
            $table->interger('ticket')->default(0)->nullable();
            $table->interger('offer')->default(0)->nullable();
            $table->interger('order')->default(0)->nullable();
            $table->interger('pickup_point')->default(0)->nullable();
            $table->interger('currency')->default(0)->nullable();
            $table->interger('report_chart')->default(0)->nullable();
            $table->interger('report')->default(0)->nullable();
            $table->interger('setting')->default(0)->nullable();
            $table->interger('review')->default(0)->nullable();
            $table->interger('contact_message')->default(0)->nullable();
            $table->interger('role')->default(0)->nullable();
            $table->interger('subscriber')->default(0)->nullable();
            $table->interger('customer')->default(0)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
