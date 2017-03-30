<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFilesEvaluation extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

      //
      Schema::table('filesEvaluation', function (Blueprint $table) {
          $table->integer('aspirant_id');
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
