<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependencytaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencytask', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_priority')->unsigned();
            $table->foreign('id_priority')->references('id')->on('tasks')->onDelete('cascade');
            $table->integer('id_dependant')->unsigned();
            $table->foreign('id_dependant')->references('id')->on('tasks')->onDelete('cascade');
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
        Schema::dropIfExists('dependencytask');
    }
}
