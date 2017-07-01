<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;

class CreateSettingsTable extends Migration
{
    /**
	 * Run the migrations.
	 *
	 * @return void
	 */

    public function up()
    {

        Schema::create('settings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('site_name');
            $table->string('logo');
            $table->string('facebook_client_id')->nullable();
            $table->string('facebook_client_secret')->nullable();
            $table->string('google_client_id')->nullable();
            $table->string('google_client_secret')->nullable();
            $table->string('twitter_client_id')->nullable();
            $table->string('twitter_client_secret')->nullable();
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
        Schema::drop('settings');
    }
    
}
