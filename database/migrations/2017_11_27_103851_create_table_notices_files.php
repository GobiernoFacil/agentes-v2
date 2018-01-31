<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNoticesFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('notice_files', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('notice_id');
          $table->string('name');
          $table->string('path');
          $table->text('comments')->nullable();
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
        Schemma::dropIfExists('notice_files');
    }
}
