<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableActivityVideos extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::create('activity_videos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('activity_id')->unsigned();
          $table->date('start')->nullable();
          $table->date('end')->nullable();
          $table->string('time')->nullable();
          $table->string('link')->nullable();
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
      Schema::dropIfExists('activity_videos');
  }
}
