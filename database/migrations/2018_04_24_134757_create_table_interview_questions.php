<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInterviewQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('interview_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('interview_questionnaire_id');
            $table->text('question')->nullable();
            $table->string('type')->nullable();
            $table->integer('required')->nullable();
            $table->integer('options_columns_number')->nullable();
            $table->integer('options_rows_number')->nullable();
            $table->string('min_label')->nullable();
            $table->string('max_label')->nullable();
            $table->string('observations')->nullable();
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
        Schema::dropIfExists('interview_questions');
    }
}
