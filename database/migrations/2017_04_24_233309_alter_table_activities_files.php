<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableActivitiesFiles extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::table('activities_files', function (Blueprint $table) {
          $table->string('name')->nullable()->change();
          $table->string('path')->nullable()->change();
          $table->text('description')->nullable()->change();
          $table->string('identifier')->nullable();
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
      Schema::dropIfExists('activities_files');
  }
}
