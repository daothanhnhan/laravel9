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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->text('title')->nullable();
            $table->text('slug')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->text('keyword')->nullable();
            $table->text('title_seo')->nullable();
            $table->text('des_seo')->nullable();
            $table->integer('state')->default(0);
            $table->integer('creator_id')->default(0);
            $table->text('newscat_id')->nullable();
            $table->integer('sort')->default(0);
            $table->integer('views')->default(0);
            
            $table->longText('info_1')->nullable();
            $table->longText('info_2')->nullable();
            $table->longText('info_3')->nullable();
            $table->longText('info_4')->nullable();
            $table->longText('info_5')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
