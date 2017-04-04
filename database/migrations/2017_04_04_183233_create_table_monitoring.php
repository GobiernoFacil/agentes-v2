<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMonitoring extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::create('monitoring', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('session_id');
          $table->string('knowledge')->nullable();
          $table->string('role')->nullable();
          $table->string('competitions')->nullable();
          $table->string('jewel')->nullable();
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
    Schema::dropIfExists('monitoring');
  }
}
