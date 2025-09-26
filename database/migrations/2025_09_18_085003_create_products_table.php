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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->text('image_sub')->nullable();
            $table->text('title')->nullable();
            $table->text('slug')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();

            $table->bigInteger('price')->default(0);
            $table->bigInteger('price_sale')->default(0);
            $table->text('product_code')->nullable();
            $table->text('product_shape')->nullable();
            $table->text('product_size')->nullable();
            $table->text('product_brand')->nullable();
            $table->text('product_origin')->nullable();
            $table->text('product_text_1')->nullable();
            $table->text('product_text_2')->nullable();
            $table->text('product_text_3')->nullable();
            $table->text('product_text_4')->nullable();
            $table->text('product_text_5')->nullable();
            $table->text('product_text_6')->nullable();

            $table->text('keyword')->nullable();
            $table->text('title_seo')->nullable();
            $table->text('des_seo')->nullable();

            $table->integer('state')->default(0);
            $table->integer('product_new')->default(0);
            $table->integer('product_hot')->default(0);
            $table->integer('creator_id')->default(0);
            $table->text('productcat_id')->nullable();
            $table->integer('sort')->default(0);
            $table->integer('views')->default(0);
            
            $table->longText('info_1')->nullable();
            $table->longText('info_2')->nullable();
            $table->longText('info_3')->nullable();
            $table->longText('info_4')->nullable();
            $table->longText('info_5')->nullable();
            $table->longText('info_6')->nullable();
            $table->longText('info_7')->nullable();
            $table->longText('info_8')->nullable();
            $table->longText('info_9')->nullable();
            $table->longText('info_10')->nullable();
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
};
