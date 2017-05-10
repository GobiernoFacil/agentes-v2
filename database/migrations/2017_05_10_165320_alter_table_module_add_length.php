<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableModuleAddLength extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::table('modules', function (Blueprint $table) {
          $table->text('title')->nullable()->change();
          $table->text('teaching_situation')->nullable()->change();
          $table->text('objective')->nullable()->change();
          $table->text('product_developed')->nullable()->change();
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
    Schema::dropIfExists('modules');
  }
}
