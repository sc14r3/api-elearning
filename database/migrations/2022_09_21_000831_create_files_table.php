<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('teacher_course_id');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->string('title');
            $table->string('description');
            $table->string('type');
            $table->string('route');
            $table->string('link')->nullable();
            $table->string('removed')->nullable();
            $table->timestamps();

            $table->foreign('teacher_course_id')
                ->references('id')
                ->on('teacher_course')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('module_id')
                ->references('id')
                ->on('modules')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
