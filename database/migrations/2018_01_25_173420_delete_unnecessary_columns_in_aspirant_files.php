<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteUnnecessaryColumnsInAspirantFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('aspirantsFiles', function (Blueprint $table) {
            $table->dropColumn(['hasVideo', 'hasLetter', 'hasEssay','hasCv','hasProof','hasPrivacy']);
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
        Schema::dropIfExists('aspirantsFiles');
    }
}
