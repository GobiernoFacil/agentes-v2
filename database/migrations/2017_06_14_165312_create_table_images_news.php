<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableImagesNews extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::create('image_news', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('newsEvents_id')->unsigned();
          $table->string('name')->nullable();
          $table->string('type')->nullable();
          $table->string('path')->nullable();
          $table->string('size')->nullable();
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
      Schema::dropIfExists('image_news');
  }
}
