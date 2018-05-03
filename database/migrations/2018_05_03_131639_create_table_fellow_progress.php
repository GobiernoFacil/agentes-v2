<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFellowProgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('fellow_progress', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('fellow_id');
          $table->integer('program_id');
          $table->integer('activity_id')->nullable();
          $table->integer('module_id')->nullable();
          $table->integer('session_id')->nullable();
          $table->integer('status')->nullable();
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
        //
        Schema::dropIfExists('fellow_progress');
    }
}
