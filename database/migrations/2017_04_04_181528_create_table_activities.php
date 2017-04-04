<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableActivities extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::create('activities', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('session_id');
          $table->string('order')->nullable();
          $table->string('name')->nullable();
          $table->string('description')->nullable();
          $table->string('facilitator_role')->nullable();
          $table->string('competitor_role')->nullable();
          $table->string('duration')->nullable();
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
    Schema::dropIfExists('activities');
  }  //
    
}
