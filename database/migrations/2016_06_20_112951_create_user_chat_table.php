<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateUserChatTable
 */

class CreateUserChatTable extends Migration
{

    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('users_chat', function(Blueprint $table){
            $table->increments('id');
            $table->integer('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('message');
            $table->integer('from')->unsigned()->nullable();
            $table->foreign('from')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('to')->unsigned()->nullable();
            $table->foreign('to')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->enum('message_seen', ['yes','no'])->default('no');
            $table->timestamps();
        });

        Schema::table('users', function($table){
            $table->enum('user_type', ['admin','user'])->default('user')->after('gender');
        });

    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::drop('users_chat');
        Schema::table('users', function($table){
	           $table->dropColumn('user_type');
        });
    }

}
