<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateTable extends Migration
{    
    public function up()
    {
        Schema::create('state', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uf', 2);
            $table->string('name', 30);
        });
    }

    public function down()
    {
        Schema::dropIfExists('state');
    }
}
