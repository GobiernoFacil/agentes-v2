<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableQuestions extends Migration
{/**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    //
    Schema::table('questions', function (Blueprint $table) {
      $table->text('question')->change();
      $table->integer('order')->nullable();
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
    Schema::dropIfExists('questions');
  }
}
