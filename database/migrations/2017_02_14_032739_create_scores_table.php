<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('mc')->default('x,x,x,x,x,x,x,x,x');
            $table->string('tc')->default('x,x');
            $table->string('hw')->default('x,x,x,x,x,x,x,x,x,x');
            $table->string('bs')->default('x,x,x,x,x,x,x,x,x');
            $table->string('ks')->default('x,x,x,x,x,x,x,x,x,x,x,x');
            $table->string('ac')->default('x,x,x,x,x,x,x,x');              
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
        Schema::dropIfExists('scores');
    }
}
