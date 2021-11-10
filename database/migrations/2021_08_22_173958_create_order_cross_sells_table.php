<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCrossSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_cross_sells', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('cross_sell_id');
            
            $table->foreign('product_id')->references('id')->on('order_prods')->onDelete('cascade');
            $table->foreign('cross_sell_id')->references('id')->on('cross_sells')->onDelete('cascade');
         //   $table->unsignedInteger('quanity');
            $table->unsignedInteger('price');
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
        Schema::dropIfExists('order_cross_sells');
    }
}
