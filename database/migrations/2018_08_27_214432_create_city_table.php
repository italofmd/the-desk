<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityTable extends Migration
{
    
    public function up()
    {
        Schema::create('city', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('state_id')->nullable()->unsigned();
            $table->foreign('state_id')->references('id')->on('state')->onUpdate('cascade')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('city');
    }
}
