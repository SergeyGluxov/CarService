<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStockIdToDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('details', function (Blueprint $table) {
            $table->String('cost');
            $table->integer('stack_id')->unsigned();
            $table->foreign('stack_id')->references('id')->on('stacks')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('details', function (Blueprint $table) {
            $table->dropColumn(array('cost', 'stack_id'));
        });
    }
}
