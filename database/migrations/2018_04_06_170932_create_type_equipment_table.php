<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeEquipmentTable extends Migration
{
    public function up()
    {
        Schema::create('type_equipment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('type_equipment');
    }
}
