<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTopics extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::create('topics', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('session_id');
          $table->string('knowledge')->nullable();
          $table->string('name')->nullable();
          $table->string('values')->nullable();
          $table->string('abilities')->nullable();
          $table->string('products')->nullable();
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
    Schema::dropIfExists('topics');
  }
}
