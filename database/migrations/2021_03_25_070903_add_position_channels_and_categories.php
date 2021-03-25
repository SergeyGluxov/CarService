<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPositionChannelsAndCategories extends Migration
{
    public function up()
    {
        Schema::table('channels', function (Blueprint $table) {
            $table->integer('position')->nullable();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('position')->nullable();
        });
    }

    public function down()
    {

    }
}
