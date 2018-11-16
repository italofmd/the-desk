<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');                        
            $table->string('cpf', 11)->nullable();
            $table->string('zipcode', 8)->nullable();            
            $table->string('neighborhood', 50)->nullable();
            $table->string('street', 100)->nullable();
            $table->string('number', 5)->nullable();
            $table->string('complement', 100)->nullable();
            $table->string('telephone', 11)->nullable();
            $table->string('cellphone', 11)->nullable();
            $table->string('whatsapp', 11)->nullable();
            $table->string('path')->nullable();
            $table->string('file')->nullable();
            $table->integer('gender_id')->nullable()->unsigned();
            $table->foreign('gender_id')->references('id')->on('gender')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('marital_id')->nullable()->unsigned();
            $table->foreign('marital_id')->references('id')->on('marital')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('city_id')->nullable()->unsigned();
            $table->foreign('city_id')->references('id')->on('city')->onUpdate('cascade')->onDelete('cascade');
            $table->primary('user_id');
            $table->timestamps();
        });
    }
  
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
