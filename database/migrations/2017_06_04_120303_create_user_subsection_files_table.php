<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubsectionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subsection_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('subsection_file_id')->unsigned();
            $table->boolean('completed');
            $table->boolean('downloaded');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('subsection_file_id')->references('id')->on('subsection_files');
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
        Schema::dropIfExists('user_subsection_files');
        Schema::enableForeignKeyConstraints();
    }
}
