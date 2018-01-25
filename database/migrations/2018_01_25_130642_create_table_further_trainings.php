<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFurtherTrainings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('further_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cv_id');
            $table->string('name');
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('location')->nullable();
            $table->string('city')->nullable();
            $table->integer('hours')->nullable();
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
        Schema::dropIfExists('further_trainings');
    }
}
