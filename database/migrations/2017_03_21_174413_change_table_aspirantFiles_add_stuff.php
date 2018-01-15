<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableAspirantFilesAddStuff extends Migration
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
            $table->integer('hasVideo')->nullable();
            $table->integer('hasLetter')->nullable();
            $table->integer('hasEssay')->nullable();
            $table->integer('hasCv')->nullable();
            $table->integer('hasPrivacy')->nullable();
            $table->integer('hasProof')->nullable();
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
