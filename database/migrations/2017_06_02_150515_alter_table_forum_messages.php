<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableForumMessages extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      //
      Schema::table('forum_messages', function (Blueprint $table) {
          $table->integer('conversation_id')->unsigned()->nullable();
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
      Schema::dropIfExists('forum_messages');
  }
}
