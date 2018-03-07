<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->text('objective')->nullable();
            $table->text('modality_results')->nullable();
            $table->text('profile')->nullable();
            $table->text('profile_eligibility_description')->nullable();
            $table->text('profile_eligibility_general')->nullable();
            $table->text('profile_eligibility_particular')->nullable();
            $table->text('term_process')->nullable();
            $table->text('unforeseen_cases')->nullable();
            $table->text('contact')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
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
        Schema::dropIfExists('notices');
    }
}
