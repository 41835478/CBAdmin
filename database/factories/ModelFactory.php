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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$words = array_reverse(config('sensitive.words'));
$factory->define(App\Models\SensitiveWord::class, function(Faker\Generator $faker) use( &$words) {
    return [
        //'name' => $faker->name,
        'name' => array_pop($words),
    ];
});

$factory->define(App\Models\UserLoginLog::class, function(Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'name' => $faker->name,
    ];
});
