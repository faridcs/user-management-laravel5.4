<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Model::unguard();

        \DB::beginTransaction();

        $count = env('SEED_RECORD_COUNT', 0);

        \DB::table('users')->delete();

        \DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'),
            'user_type' => 'admin'
        ]);

        if (env('APP_ENV') !== 'production') {

            factory(User::class, 40)->create();
        }

        \DB::commit();
    }

}
