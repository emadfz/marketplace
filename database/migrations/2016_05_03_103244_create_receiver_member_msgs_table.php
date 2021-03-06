<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMingleFollowingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mingle_followings', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('user_id')->unsigned();
            $table->integer('following_id')->unsigned();            
            $table->string('user_type','100');         //admin or employee and buyer or seller   
            $table->string('following_type','100');    //admin or employee and buyer or seller       
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mingle_followings');
    }
}