<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room', function (Blueprint $table) {
            $table->id();
            $table->string('roomID');
            $table->string('buildingID');
            $table->string('status');
            $table->string('note')->nullable();
            $table->timestamps();

            $table->unique(['roomID','buildingID']);
            $table->foreign('buildingID')->references('buildingID')->on('building');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room');
    }
}
