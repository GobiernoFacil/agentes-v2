<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSatisfactionSurvey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('survey_satisfaction', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->nullable();
          $table->integer('sur_1')->nullable();
          $table->text('sur_j1')->nullable();
          $table->integer('sur_2')->nullable();
          $table->text('sur_j2')->nullable();
          $table->integer('sur_3_1')->nullable();
          $table->integer('sur_3_2')->nullable();
          $table->integer('sur_3_3')->nullable();
          $table->integer('sur_3_4')->nullable();
          $table->integer('sur_3_5')->nullable();
          $table->integer('sur_4')->nullable();
          $table->integer('sur_5_1')->nullable();
          $table->integer('sur_5_2')->nullable();
          $table->integer('sur_5_3')->nullable();
          $table->integer('sur_5_4')->nullable();
          $table->integer('sur_6_1')->nullable();
          $table->integer('sur_6_2')->nullable();
          $table->integer('sur_6_3')->nullable();
          $table->integer('sur_7_1')->nullable();
          $table->integer('sur_7_2')->nullable();
          $table->integer('sur_7_3')->nullable();
          $table->integer('sur_8')->nullable();
          $table->text('sur_j8')->nullable();
          $table->integer('sur_9')->nullable();
          $table->text('sur_j9')->nullable();
          $table->integer('sur_10')->nullable();
          $table->text('sur_j10')->nullable();
          $table->integer('sur_11')->nullable();
          $table->text('sur_j12')->nullable();
          $table->integer('sur_13_1')->nullable();
          $table->integer('sur_13_2')->nullable();
          $table->integer('sur_13_3')->nullable();
          $table->integer('sur_13_4')->nullable();
          $table->integer('sur_13_5')->nullable();
          $table->integer('sur_14_1')->nullable();
          $table->integer('sur_14_2')->nullable();
          $table->integer('sur_14_3')->nullable();
          $table->integer('sur_14_4')->nullable();
          $table->integer('sur_14_5')->nullable();
          $table->integer('sur_15_1')->nullable();
          $table->integer('sur_15_2')->nullable();
          $table->integer('sur_15_3')->nullable();
          $table->integer('sur_15_4')->nullable();
          $table->integer('sur_15_5')->nullable();
          $table->integer('sur_16_1')->nullable();
          $table->integer('sur_16_2')->nullable();
          $table->integer('sur_16_3')->nullable();
          $table->integer('sur_16_4')->nullable();
          $table->integer('sur_16_5')->nullable();
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
        Schema::dropIfExists('survey_satisfaction');
    }
}
