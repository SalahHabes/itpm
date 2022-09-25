<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associationuser', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_manager')->unsigned();
            $table->foreign('id_manager')->references('id')->on('users');
            $table->integer('id_employee')->unsigned();
            $table->foreign('id_employee')->references('id')->on('users');
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
        Schema::dropIfExists('associationuser');
    }
}
