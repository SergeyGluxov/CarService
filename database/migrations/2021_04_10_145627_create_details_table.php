<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('cost');
            $table->integer('weight');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('details');
    }
}
