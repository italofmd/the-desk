<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTable extends Migration
{

    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {            
            $table->increments('id');
            $table->string('subject', 30);
            $table->string('description', 250);
            $table->string('file')->nullable();
            $table->string('file_name')->nullable();
            $table->string('path')->nullable();
            $table->dateTime('conclusion_date')->nullable();
            $table->integer('priority_id')->unsigned();
            $table->foreign('priority_id')->references('id')->on('priority')->onDelete('cascade');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->integer('equipment_id')->unsigned()->nullable();
            $table->foreign('equipment_id')->references('id')->on('equipment')->onDelete('cascade');                        
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('ticket_category')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('agent_id')->unsigned()->nullable();
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket');
    }
}