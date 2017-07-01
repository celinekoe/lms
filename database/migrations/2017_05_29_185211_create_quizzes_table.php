<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unit_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->integer('subsection_id')->unsigned();
            $table->string('name');
            $table->boolean('graded');
            $table->string('grading_method');
            $table->integer('total_attempts');
            $table->integer('weight');
            $table->integer('total_questions');
            $table->integer('time_limit');
            $table->dateTime('submit_by_date');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('section_id')->references('id')->on('sections');
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
        Schema::dropIfExists('quizzes');
        Schema::enableForeignKeyConstraints();
    }
}
