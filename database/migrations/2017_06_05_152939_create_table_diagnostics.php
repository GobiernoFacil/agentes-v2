<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDiagnostics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('diagnostic_evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->longText('answer_1')->nullable();
            $table->longText('answer_2')->nullable();
            $table->longText('answer_3')->nullable();
            $table->longText('answer_4')->nullable();
            $table->longText('answer_5')->nullable();
            $table->integer('answer_ponderation_1')->nullable();
            $table->integer('answer_ponderation_2')->nullable();
            $table->integer('answer_ponderation_3')->nullable();
            $table->integer('answer_ponderation_4')->nullable();
            $table->integer('answer_ponderation_5')->nullable();
            $table->integer('total_score')->nullable();
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
        Schema::dropIfExists('diagnostic_evaluations');
    }
}
