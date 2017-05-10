<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableTopicsAddLength extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::table('topics', function (Blueprint $table) {
          $table->text('knowledge')->nullable()->change();
          $table->text('name')->nullable()->change();
          $table->text('values')->nullable()->change();
          $table->text('abilities')->nullable()->change();
          $table->text('products')->nullable()->change();
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
    Schema::dropIfExists('topics');
  }
}
