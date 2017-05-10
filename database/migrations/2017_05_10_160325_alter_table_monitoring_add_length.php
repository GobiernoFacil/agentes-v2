<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableMonitoringAddLength extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::table('monitoring', function (Blueprint $table) {
          $table->text('knowledge')->nullable()->change();
          $table->text('role')->nullable()->change();
          $table->text('competitions')->nullable()->change();
          $table->text('jewel')->nullable()->change();
          $table->text('attitude')->nullable()->change();
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
    Schema::dropIfExists('monitoring');
  }
}
