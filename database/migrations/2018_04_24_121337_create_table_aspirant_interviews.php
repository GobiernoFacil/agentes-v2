<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAspirantInterviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('aspirant_interviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aspirant_id');
            $table->integer('user_id');
            $table->integer('interview_questionnaire_id');
            $table->integer('notice_id');
            $table->string('type')->nullable();
            $table->text('institution')->nullable();
            $table->double('score')->nullable();
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
        Schema::dropIfExists('aspirant_interviews');
    }
}
