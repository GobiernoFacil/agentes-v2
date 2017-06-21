<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFellowAnswers extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    //
    Schema::create('fellow_answers', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id')->unsigned();
      $table->integer('question_id')->unsigned();
      $table->integer('answer_id')->unsigned();
      $table->integer('questionInfo_id')->unsigned();
      $table->integer('correct')->unsigned()->nullable();
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
    Schema::dropIfExists('fellow_answers');
  }
}
