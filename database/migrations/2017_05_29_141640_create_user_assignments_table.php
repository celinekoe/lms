<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('staff_id')->unsigned()->nullable();
            $table->integer('assignment_id')->unsigned();
            $table->date('submitted_at')->nullable();
            $table->float('grade')->nullable();
            $table->string('grade_comment')->nullable();
            $table->date('graded_at')->nullable();
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('staff_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_assignments');
        Schema::enableForeignKeyConstraints();
    }
}
