<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('assignment_id')->unsigned()->nullable();
            $table->integer('quiz_id')->unsigned()->nullable();
            $table->integer('event_id')->unsigned()->nullable();
            $table->integer('message_id')->unsigned()->nullable();
            $table->boolean('read');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('assignment_id')->references('id')->on('assignments');
            $table->foreign('quiz_id')->references('id')->on('quizzes');
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('message_id')->references('id')->on('messages');
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
        Schema::dropIfExists('notifications');
        Schema::enableForeignKeyConstraints();
    }
}
