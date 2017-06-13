<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFellowDataSemblancesChange extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::table('fellow_data', function (Blueprint $table) {
          $table->text('semblance')->nullable()->change();
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
      Schema::dropIfExists('fellow_data');
  }
}
