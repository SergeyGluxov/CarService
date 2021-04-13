<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisplacementsTable extends Migration
{

    public function up()
    {
        Schema::create('displacements', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('detail_id')->unsigned();
            $table->foreign('detail_id')->references('id')->on('details')->onDelete('cascade');

            $table->integer('stack_id')->unsigned();
            $table->foreign('stack_id')->references('id')->on('stacks')->onDelete('cascade');

            $table->integer('stock_id')->unsigned();
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('displacements');
    }
}
