<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAspirantEvaluationEraseColumns extends Migration
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
            $table->dropColumn(['experience', 'experience1','experience2','experience3','experienceJ1','experiencej2',
            'institution','evaluator',
            'essay','essay1','essay2','essay3','essay4',
            'video','video1','video2','video3','video4']);
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
