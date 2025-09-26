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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('cart_id')->default(0);
            $table->foreignId('cart_id');
            $table->integer('product_id')->default(0);
            $table->bigInteger('product_price')->default(0);
            $table->integer('product_quantity')->default(0);
            $table->bigInteger('product_price_total')->default(0);

            $table->text('color')->nullable();
            $table->text('size')->nullable();
            $table->text('info_1')->nullable();
            $table->text('info_2')->nullable();
            $table->text('info_3')->nullable();
            $table->text('info_4')->nullable();
            $table->text('info_5')->nullable();


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
        Schema::dropIfExists('cart_items');
    }
};
