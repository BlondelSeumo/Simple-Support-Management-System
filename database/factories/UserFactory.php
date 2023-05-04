<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

// $designationArray = ['Admin', 'Support Engneer', 'Client'];
$designationArray = ['Client', 'Client', 'Client'];
$factory->define(User::class, function (Faker $faker) use ($designationArray) {
    return [
        'name'           => $faker->name,
        'designation'    => $designationArray[rand(0, 2)],
        'email'          => $faker->unique()->safeEmail,
        'username'       => $faker->userName,
        'password'       => bcrypt('123456'),
        'phone'          => $faker->phoneNumber,
        'address'        => $faker->address,
        'date_of_birth'  => date('Y-m-d H:i:s'),
        'joining_date'   => date('Y-m-d H:i:s'),
        'last_login_at'  => date('Y-m-d H:i:s'),
        'remember_token' => Str::random(10),
    ];
});
