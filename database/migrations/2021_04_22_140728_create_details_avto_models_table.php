<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsAvtoModelsTable extends Migration
{

    public function up()
    {
        Schema::create('details_avto_models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('detail_id')->unsigned();
            $table->foreign('detail_id')->references('id')->on('details')->onDelete('cascade');
            $table->integer('avto_model_id')->unsigned();
            $table->foreign('avto_model_id')->references('id')->on('avto_models')->onDelete('cascade');
            $table->integer('cost');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('details_avto_models');
    }
}
