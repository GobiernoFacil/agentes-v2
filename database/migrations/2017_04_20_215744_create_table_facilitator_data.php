<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFacilitatorData extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::create('facilitator_data', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->string('degree')->nullable();
          $table->string('web')->nullable();
          $table->string('twitter')->nullable();
          $table->string('facebook')->nullable();
          $table->string('linkedin')->nullable();
          $table->string('other')->nullable();
          $table->string('semblance')->nullable();
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
      Schema::dropIfExists('facilitator_data');
  }
}
