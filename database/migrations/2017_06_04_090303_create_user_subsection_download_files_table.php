<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubsectionDownloadFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subsection_download_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('subsection_id')->unsigned();
            $table->string('name');
            $table->string('type');
            $table->string('extension');
            $table->string('url');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_subsection_download_files');
        Schema::enableForeignKeyConstraints();
    }
}
