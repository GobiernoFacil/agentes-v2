<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNewsEvents extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::create('news_events', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned()->nullable();
          $table->text('title')->nullable();
          $table->longtext('content')->nullable();
          $table->date('start')->nullable();
          $table->date('end')->nullable();
          $table->text('slug')->nullable();
          $table->string('time')->nullable();
          $table->string('type')->nullable();
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
      Schema::dropIfExists('news_events');
  }
}
