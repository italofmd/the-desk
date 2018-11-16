<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaritalTable extends Migration
{
    
    public function up()
    {
        Schema::create('marital', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('marital');
    }
}
