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
            $table->string('name');
            $table->string('surname');
            $table->string('address');
            $table->unsignedInteger('status_id')->default(1);
            $table->unsignedInteger('user_id')->nullable();
            $table->date('dost_time')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedInteger('payment_id');
            $table->unsignedInteger('order_cross_sell')->nullable();
            $table->bigInteger('total');
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
