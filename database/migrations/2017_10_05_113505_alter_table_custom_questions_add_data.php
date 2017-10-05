<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCustomQuestionsAddData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('custom_questions', function (Blueprint $table) {
            $table->integer('required')->nullable();
            $table->integer('options_columns_number')->nullable();
            $table->integer('options_rows_number')->nullable();
            $table->string('min_label')->nullable();
            $table->string('max_label')->nullable();
            $table->text('observations')->nullable();
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
        Schema::dropIfExists('custom_questions');
    }
}
