<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('teacher_course_id');
            $table->string('type');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->string('description');
            $table->date('application_date');
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
        Schema::dropIfExists('exams');
    }
}
