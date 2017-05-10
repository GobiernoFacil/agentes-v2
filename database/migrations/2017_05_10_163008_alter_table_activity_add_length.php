<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableActivityAddLength extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::table('activities', function (Blueprint $table) {
          $table->text('name')->nullable()->change();
          $table->text('description')->nullable()->change();
          $table->text('facilitator_role')->nullable()->change();
          $table->text('competitor_role')->nullable()->change();
          $table->text('slug')->nullable()->change();
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
    Schema::dropIfExists('activities');
  }  //
}
