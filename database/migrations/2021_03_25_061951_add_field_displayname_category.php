<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldDisplaynameCategory extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->String('display_name');
            $table->String('logo');
        });
    }

    public function down()
    {
        //
    }
}
