<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTopChannels extends Migration
{

    public function up()
    {
        Schema::table('channels', function (Blueprint $table) {
            $table->boolean('is_top')->default(false);
        });
    }

    public function down()
    {
        //
    }
}
