<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvtoModelsTable extends Migration
{
    public function up()
    {
        Schema::create('avto_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('models');
    }
}
