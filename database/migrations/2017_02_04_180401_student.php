<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nickname');
            $table->string('kattis');
            $table->string('country');
            $table->string('mc')->default('x,x,x,x,x,x,x,x,x');
            $table->string('tc')->default('x,x');
            $table->string('hw')->default('x,x,x,x,x,x,x,x,x,x');
            $table->string('bs')->default('x,x,x,x,x,x,x,x,x');
            $table->string('ks')->default('x,x,x,x,x,x,x,x,x,x,x,x');
            $table->string('ac')->default('x,x,x,x,x,x,x,x');  
            $table->string('avatar')->nullable();
            $table->string('comment')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('student');
    }
}
