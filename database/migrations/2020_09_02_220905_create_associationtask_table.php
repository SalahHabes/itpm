<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationtaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associationtask', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_task')->unsigned();
            $table->foreign('id_task')->references('id')->on('tasks')->onDelete('cascade');
            $table->integer('id_employee')->unsigned();
            $table->foreign('id_employee')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('associationtask');
    }
}
