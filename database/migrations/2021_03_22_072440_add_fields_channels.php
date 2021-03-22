<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsChannels extends Migration
{
    public function up()
    {
        Schema::table('channels', function (Blueprint $table) {
            $table->integer('category_id')->default(1)->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
}
