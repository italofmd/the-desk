<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTicketCategoryTable extends Migration
{
    
    public function up()
    {
        Schema::create('ticket_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20)->unique();
            $table->timestamps();
        });        
    }

    public function down()
    {
        Schema::dropIfExists('ticket_category');
    }
}
