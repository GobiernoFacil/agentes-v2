<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAspirantsEvaluationAddComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('aspirantEvaluation', function (Blueprint $table) {
            $table->text('experienceComments')->nullable();
            $table->text('videoComments')->nullable();
            $table->text('essayComments')->nullable();
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
