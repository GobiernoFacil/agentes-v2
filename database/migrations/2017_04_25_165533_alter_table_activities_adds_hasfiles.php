<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableActivitiesAddsHasfiles extends Migration
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
      $table->string('hasfiles')->nullable();
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
  }
}
