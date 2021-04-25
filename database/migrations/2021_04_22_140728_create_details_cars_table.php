<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsCarsTable extends Migration
{

    public function up()
    {
        Schema::create('details_cars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('detail_id')->unsigned();
            $table->foreign('detail_id')->references('id')->on('details')->onDelete('cascade');
            $table->integer('car_id')->unsigned();
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->integer('cost');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('details_cars');
    }
}
