<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCvs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cvs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aspirant_id');
            $table->integer('age')->nullable();
            $table->integer('phone')->nullable();
            $table->integer('mobile')->nullable();
            $table->integer('email')->nullable();
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
        Schema::dropIfExists('cvs');
    }
}
