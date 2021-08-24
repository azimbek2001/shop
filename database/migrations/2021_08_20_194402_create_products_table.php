<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('info');

            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('category_id');
            $table->text('image')->nullable();
            $table->string('weight')->nullable();
            $table->boolean('having')->default(1);
            $table->unsignedInteger('price')->default(0);
            $table->boolean('is_hit')->default(0);
            $table->unsignedInteger('old_price')->nullable();
             $table->text('ingridients')->nullable();
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
        Schema::dropIfExists('products');
    }
}
