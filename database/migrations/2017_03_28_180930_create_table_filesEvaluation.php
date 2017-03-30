<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFilesEvaluation extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

      //
      Schema::create('filesEvaluation', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->string('institution')->nullable();
          $table->integer('hasVideo')->nullable();
          $table->integer('hasLetter')->nullable();
          $table->integer('hasEssay')->nullable();
          $table->integer('hasCv')->nullable();
          $table->integer('hasPrivacy')->nullable();
          $table->integer('hasProof')->nullable();
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
    Schema::dropIfExists('filesEvaluation');
  }
}
