<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_project')->unsigned();
            $table->foreign('id_project')->references('id')->on('projects')->onDelete('cascade');
            $table->string('name', 30);
            $table->longText('description')->nullable();
            $table->string('filelink')->nullable();
            $table->date('bdate')->nullable();
            $table->date('edate')->nullable();
            $table->date('fdate')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
