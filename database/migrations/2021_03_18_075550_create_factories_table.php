<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactoriesTable extends Migration
{
    public function up()
    {
        Schema::create('factories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('factory_details');
    }
}
