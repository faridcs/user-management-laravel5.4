<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $this->call(SettingsSeeder::class);
        $this->call(EmailTemplateTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionSeeder::class);
    }

}
