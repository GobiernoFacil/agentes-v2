<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAspirantEvaluation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('aspirantEvaluation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aspirant_id');
            $table->integer('experience');
            $table->integer('experience1');
            $table->integer('experience2');
            $table->integer('experience3');
            $table->text('experienceJ1');
            $table->text('experienceJ2');
            $table->string('institution');
            $table->string('evaluator');
            $table->integer('essay');
            $table->integer('essay1');
            $table->integer('essay2');
            $table->integer('essay3');
            $table->integer('essay4');
            $table->integer('video');
            $table->integer('video1');
            $table->integer('video2');
            $table->integer('video3');
            $table->integer('video4');
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
        Schema::dropIfExists('aspirantEvaluation');
    }
}
