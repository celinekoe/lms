<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubsectionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsection_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subsection_id')->unsigned();
            $table->string('name');
            $table->string('type');
            $table->string('extension');
            $table->string('url');
            $table->foreign('subsection_id')->references('id')->on('subsections');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('subsection_files');
        Schema::enableForeignKeyConstraints();
    }
}
