<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->string('timeStart');
            $table->string('timeEnd');
            $table->string('buildingID');
            $table->string('roomID');
            $table->string('subjectID')->nullable();
            $table->string('subjectName');
            $table->string('credit')->nullable();
            $table->string('teacher');
            $table->integer('status')->default(0);
            $table->string('user')->nullable();
            $table->string('listDevice')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
