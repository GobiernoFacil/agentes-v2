<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableModules extends Migration
{
  public function up()
  {
      //
      Schema::table('modules', function (Blueprint $table) {
          $table->string('title')->nullable()->change();
          $table->string('number_sessions')->nullable()->change();
          $table->string('number_hours')->nullable()->change();
          $table->string('modality')->nullable()->change();
          $table->string('teaching_situation')->nullable()->change();
          $table->string('objective')->nullable()->change();
          $table->string('product_developed')->nullable()->change();
          $table->string('slug')->nullable()->change();
          $table->datetime('start')->nullable()->change();
          $table->datetime('end')->nullable()->change();
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
    Schema::dropIfExists('modules');
  }
}
