<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConversationLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('conversation_logs', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('conversation_id')->nullable();
          $table->integer('user_id')->nullable();
          $table->integer('message_id')->nullable();
          $table->string('status')->nullable();
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
        Schema::dropIfExists('conversation_logs');
    }
}
