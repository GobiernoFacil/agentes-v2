<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAspirantActivationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('aspirant_activations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aspirant_id')->unsigned();
            $table->foreign('aspirant_id')->references('id')->on('aspirants')->onDelete('cascade');
            $table->string('token');
            $table->timestamps();
        });

        Schema::table('aspirants', function (Blueprint $table) {
            $table->boolean('is_activated');
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
        Schema::drop("aspirant_activations");

        Schema::table('aspirants', function (Blueprint $table) {
            $table->dropColumn('is_activated');
        });
    }
}
