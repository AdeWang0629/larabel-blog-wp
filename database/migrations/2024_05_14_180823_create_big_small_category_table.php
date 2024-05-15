<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigSmallCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('big_small_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('big_category');
            $table->unsignedBigInteger('small_category');
            $table->timestamps();

            $table->foreign('big_category')->references('id')->on('big_category')->onDelete('cascade');
            $table->foreign('small_category')->references('id')->on('small_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('big_small_category');
    }
}
