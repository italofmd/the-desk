<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentTable extends Migration
{

    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('network_name', 30)->nullable();
            $table->string('tag_name', 30)->nullable();
            $table->string('ip', 30)->nullable();
            $table->string('model', 50)->nullable();
            $table->string('serial_number', 50)->nullable();
            $table->string('note', 200)->nullable();
            $table->integer('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('type_equipment')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('manufacturer_id')->unsigned()->nullable();
            $table->foreign('manufacturer_id')->references('id')->on('manufacturer')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}
