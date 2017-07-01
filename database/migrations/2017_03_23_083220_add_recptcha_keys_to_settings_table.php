<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRecptchaKeysToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('recaptcha_public_key');
            $table->string('recaptcha_private_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('recaptcha_public_key');
            $table->dropColumn('recaptcha_private_key');
        });
    }

}
