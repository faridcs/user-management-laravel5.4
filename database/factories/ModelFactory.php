<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Models\User;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('123456'),
        'gender' => $faker->randomElement(['male', 'female']),
        'status' => $faker->randomElement(['active', 'inactive']),
        'dob'      => \Carbon\Carbon::now(),
        'remember_token' => str_random(10),
    ];
});
// For roles
$factory->define(\App\Role::class, function (Faker\Generator $faker) {
    return [
        'name'         => $faker->name,
        'display_name' => $faker->firstName,
        'description'  => $faker->text(200),
        'created_at'          => \Carbon\Carbon::now(),
        'updated_at'          => \Carbon\Carbon::now()
    ];
});
// For Permission
$factory->define(\App\Permission::class, function (Faker\Generator $faker) {
    return [
        'name'         => $faker->name,
        'display_name' => $faker->firstName,
        'description'  => $faker->text(200),
        'created_at'          => \Carbon\Carbon::now(),
        'updated_at'          => \Carbon\Carbon::now()
    ];
});