<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSurveyFacilitators extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::create('survey_facilitators', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id')->nullable();
        $table->integer('session_id')->nullable();
        $table->integer('facilitator_id')->nullable();
        $table->integer('fa_1')->nullable();
        $table->integer('fa_2')->nullable();
        $table->integer('fa_3')->nullable();
        $table->integer('fa_4')->nullable();
        $table->integer('fa_5')->nullable();
        $table->integer('fa_6')->nullable();
        $table->text('fa_7')->nullable();
        $table->text('fa_8')->nullable();
        $table->integer('fa_9')->nullable();
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
      Schema::dropIfExists('survey_facilitators');
  }
}
