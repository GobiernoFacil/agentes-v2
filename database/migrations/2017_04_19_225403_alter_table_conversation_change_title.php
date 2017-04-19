<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableConversationChangeTitle extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
       //
       Schema::table('conversations', function (Blueprint $table) {
           $table->string('title')->nullable()->change();
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
       Schema::dropIfExists('conversations');
   }
}
