<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAspirantEvaluationChangesFieldsToDouble extends Migration
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
            $table->decimal('experienceGrade',15,4)->nullable()->change();
            $table->decimal('videoGrade',15,4)->nullable()->change();
            $table->decimal('essayGrade',15,4)->nullable()->change();
            $table->decimal('grade',15,4)->nullable()->change();
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
