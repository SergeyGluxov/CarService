<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand');
            $table->string('model');
            $table->string('image')->default('default.png');
            $table->string('state_number');
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
        //Сначало удалить саму связь(т.е внешний ключ)
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['cars_id']);
        });
        //Потом удалить таблицу
        Schema::dropIfExists('cars');
    }
}
