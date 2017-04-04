<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('module_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('module_id');
            $table->string('order')->nullable();
            $table->string('name')->nullable();
            $table->string('modality')->nullable();
            $table->string('objective')->nullable();
            $table->string('hours')->nullable();
            $table->string('week')->nullable();
            $table->string('comments')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
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
      Schema::dropIfExists('module_sessions');
    }
}
