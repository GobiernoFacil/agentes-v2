<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableForumLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('forum_logs', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->nullable();
          $table->integer('forum_id')->nullable();
          $table->integer('conversation_id')->nullable();
          $table->integer('message_id')->nullable();
          $table->string('action')->nullable();
          $table->string('type')->nullable();
          $table->timestamps();
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
        Schema::dropIfExists('forum_logs');
    }
}
