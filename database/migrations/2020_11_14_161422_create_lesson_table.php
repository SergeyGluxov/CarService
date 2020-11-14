<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonTable extends Migration
{

    public function up()
    {
        Schema::create('Lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('sections_id')->unsigned();
            $table->foreign('sections_id')->references('id')->on('Sections')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Lessons');
    }
}
