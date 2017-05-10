<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableActivityRequirementsAddLength extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::table('activity_requirements', function (Blueprint $table) {
          $table->text('name')->nullable()->change();
          $table->text('description')->nullable()->change();
          $table->text('material_link')->nullable()->change();
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
