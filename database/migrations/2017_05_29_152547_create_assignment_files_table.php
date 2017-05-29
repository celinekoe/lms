<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assignment_id')->unsigned();
            $table->string('name');
            $table->string('type');
            $table->string('extension');
            $table->string('url');
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
