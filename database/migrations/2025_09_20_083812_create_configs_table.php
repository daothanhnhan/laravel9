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
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('keyword')->nullable();
            $table->text('intro')->nullable();

            $table->text('logo')->nullable();
            $table->text('icon')->nullable();
            $table->text('banner_1')->nullable();
            $table->text('banner_2')->nullable();
            $table->text('banner_3')->nullable();
            $table->text('banner_4')->nullable();
            $table->text('banner_5')->nullable();

            $table->text('content_home_1')->nullable();
            $table->text('content_home_2')->nullable();
            $table->text('content_home_3')->nullable();
            $table->text('content_home_4')->nullable();
            $table->text('content_home_5')->nullable();
            $table->text('content_home_6')->nullable();
            $table->text('content_home_7')->nullable();
            $table->text('content_home_8')->nullable();
            $table->text('content_home_9')->nullable();
            $table->text('content_home_10')->nullable();

            $table->text('embed_code_header')->nullable();
            $table->text('embed_code_footer')->nullable();
            // $table->integer('state')->default(0);
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
        Schema::dropIfExists('configs');
    }
};
