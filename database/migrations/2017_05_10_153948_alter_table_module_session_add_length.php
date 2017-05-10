<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableModuleSessionAddLength extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::table('module_sessions', function (Blueprint $table) {
          $table->text('name')->nullable()->change();
          $table->text('objective')->nullable()->change();
          $table->text('week')->nullable()->change();
          $table->text('comments')->nullable()->change();
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
    Schema::dropIfExists('module_sessions');
  }
}
