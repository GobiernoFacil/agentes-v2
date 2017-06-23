<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFileEvaluations extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('file_evaluations', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id');
      $table->integer('fellow_id');
      $table->integer('activity_id');
      $table->string('name');
      $table->string('score');
      $table->string('path');
      $table->text('url')->nullable();
      $table->text('comments')->nullable();
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
      Schema::dropIfExists('file_evaluations');
  }
}
