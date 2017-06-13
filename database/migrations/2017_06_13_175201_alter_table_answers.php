<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAnswers extends Migration
{
  /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
      //
      Schema::table('answers', function (Blueprint $table) {
        $table->text('value')->nullable()->change();
        $table->string('type')->nullable()->change();
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
      Schema::dropIfExists('answers');
    }
}
