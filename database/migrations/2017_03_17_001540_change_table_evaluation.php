<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableEvaluation extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    //
    Schema::table('aspirantEvaluation', function (Blueprint $table) {
      $table->integer('experience')->nullable()->change();
      $table->integer('experience1')->nullable()->change();
      $table->integer('experience2')->nullable()->change();
      $table->integer('experience3')->nullable()->change();
      $table->text('experienceJ1')->nullable()->change();
      $table->text('experienceJ2')->nullable()->change();
      $table->string('institution')->nullable()->change();
      $table->string('evaluator')->nullable()->change();
      $table->integer('essay')->nullable()->change();
      $table->integer('essay1')->nullable()->change();
      $table->integer('essay2')->nullable()->change();
      $table->integer('essay3')->nullable()->change();
      $table->integer('essay4')->nullable()->change();
      $table->integer('video')->nullable()->change();
      $table->integer('video1')->nullable()->change();
      $table->integer('video2')->nullable()->change();
      $table->integer('video3')->nullable()->change();
      $table->integer('video4')->nullable()->change();
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
      Schema::dropIfExists('aspirantEvaluation');
  }
}
