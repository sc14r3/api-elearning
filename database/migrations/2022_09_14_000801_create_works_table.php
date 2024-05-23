<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('teacher_course_id');
            $table->unsignedBigInteger('module_id');
            $table->text('description');
            $table->date('date');
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
        Schema::dropIfExists('works');
    }
}
