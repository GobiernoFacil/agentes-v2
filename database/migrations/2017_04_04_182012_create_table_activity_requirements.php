<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableActivityRequirements extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::create('activity_requirements', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('activity_id');
          $table->string('order')->nullable();
          $table->string('name')->nullable();
          $table->string('description')->nullable();
          $table->string('material_link')->nullable();
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
    Schema::dropIfExists('activity_requirements');
  }
}
