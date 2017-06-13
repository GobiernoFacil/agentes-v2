<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableQuestionsAddsAnswerId extends Migration
{
  /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
      //
      Schema::table('questions', function (Blueprint $table) {
        $table->integer('answer_id')->nullable();
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
      Schema::dropIfExists('questions');
    }
}
