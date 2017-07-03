<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('unit_id')->unsigned()->nullable();
            $table->integer('section_id')->unsigned()->nullable();
            $table->integer('subsection_id')->unsigned()->nullable();
            $table->integer('assignment_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('extension');
            $table->string('type');
            $table->integer('size')->nullable();
            $table->time('length')->nullable();
            $table->string('url');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('subsection_id')->references('id')->on('subsections');
            $table->foreign('assignment_id')->references('id')->on('assignments');
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
        Schema::dropIfExists('files');
        Schema::enableForeignKeyConstraints();
    }
}
