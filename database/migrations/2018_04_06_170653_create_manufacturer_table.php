<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManufacturerTable extends Migration
{

    public function up()
    {
        Schema::create('manufacturer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('manufacturer');
    }
}
