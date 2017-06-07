<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDiagnosticEvaluation extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::table('diagnostic_evaluations', function (Blueprint $table) {
          $table->string('answer_q1_1')->nullable();
          $table->string('answer_q1_2')->nullable();
          $table->string('answer_q1_3')->nullable();
          $table->text('answer_q1_j')->nullable();
          $table->string('answer_q2_1')->nullable();
          $table->string('answer_q2_2')->nullable();
          $table->text('answer_q2_j')->nullable();
          $table->string('answer_q3_1')->nullable();
          $table->string('answer_q3_2')->nullable();
          $table->string('answer_q3_3')->nullable();
          $table->string('answer_q3_4')->nullable();
          $table->text('answer_q3_j')->nullable();
          $table->string('answer_q4_1')->nullable();
          $table->string('answer_q4_2')->nullable();
          $table->text('answer_q4_j')->nullable();
          $table->string('answer_q5_1')->nullable();
          $table->string('answer_q5_2')->nullable();
          $table->string('answer_q5_3')->nullable();
          $table->text('answer_q5_j')->nullable();
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
      Schema::dropIfExists('diagnostic_evaluations');
  }
}
