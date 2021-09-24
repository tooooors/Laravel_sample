<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Messages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('messages', function(Blueprint $table){
            $table->id();
            //$table->increments('message_id');
            // group_idカラム
            //$table->integer('group_id',11);
            $table->integer('group_id');
            // titleカラム
            $table->string('title', 250);
            // messageカラム
            $table->text('message', 29999);
            // statusカラム
            //$table->tinyInteger('status',1);
            $table->tinyInteger('status');
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
        //
    }
}
