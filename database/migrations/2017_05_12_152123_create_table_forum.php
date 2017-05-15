<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableForum extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::create('forums', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('session_id')->unsigned()->nullable();
          $table->integer('user_id')->unsigned()->nullable();
          $table->string('state_name')->nullable();
          $table->text('topic')->nullable();
          $table->text('description')->nullable();
          $table->text('slug')->nullable();
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
      Schema::dropIfExists('forums');
  }
}
