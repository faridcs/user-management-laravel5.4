<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('email_notification');
            $table->boolean('recaptcha');
            $table->boolean('remember_me')->default(1);
            $table->boolean('forget_password')->default(1);
            $table->boolean('allow_register')->default(1);
            $table->boolean('email_confirmation');
            $table->boolean('custom_field_on_register');
            $table->string('mail_driver', 30);
            $table->string('mail_host', 30);
            $table->string('mail_port', 30);
            $table->string('mail_username', 30);
            $table->string('mail_password', 30);
            $table->string('mail_encryption', 30);
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
            $table->dropColumn('email_notification');
            $table->dropColumn('recaptcha');
            $table->dropColumn('remember_me');
            $table->dropColumn('forget_password');
            $table->dropColumn('allow_register');
            $table->dropColumn('email_confirmation');
            $table->dropColumn('custom_field_on_register');
            $table->dropColumn('mail_driver');
            $table->dropColumn('mail_host');
            $table->dropColumn('mail_port');
            $table->dropColumn('mail_username');
            $table->dropColumn('mail_password');
            $table->dropColumn('mail_encryption');
        });
    }

}
