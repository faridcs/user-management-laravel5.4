<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        \DB::table('settings')->delete();

        \DB::statement('ALTER TABLE settings AUTO_INCREMENT = 1');

        DB::table('settings')->insert([
            ['site_name'   => 'NamaTik',
             'logo'        => 'namatik.png',
             'name'        => 'NamaTik',
             'email'       => 'info@example.com'
            ]
        ]);
    }

}
