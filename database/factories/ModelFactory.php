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
//User Factory
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

//PlaceType Factory
$factory->define(App\PlaceType::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
    ];
});

//Place Factory
$factory->define(App\Place::class, function (Faker\Generator $faker) use ($factory) {

    return [
        'name' => $faker->company,
        'id_type' => factory(App\PlaceType::class)->create()->id,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
    ];
});

//Visit Factory
$factory->define(App\Visit::class, function (Faker\Generator $faker) use ($factory) {

    return [
        'id_user' => factory(App\User::class)->create()->id,
        'id_place' => factory(App\Place::class)->create()->id,
        'date' => $faker->year.'-'.$faker->month.'-'.$faker->dayOfMonth,
    ];
});

//Note Factory
$factory->define(App\Note::class, function (Faker\Generator $faker) use ($factory) {

    return [
        'id_visit' => factory(App\Visit::class)->create()->id,
        'n_price' => $faker->randomFloat(1, 0, 20),
        'n_quantity' => $faker->randomFloat(1, 0, 20),
        'n_quality' => $faker->randomFloat(1, 0, 20),
        'n_ambient' => $faker->randomFloat(1, 0, 20),
    ];
});


//Virtue Factory
$factory->define(App\Virtue::class, function (Faker\Generator $faker) use ($factory) {

    return [
        'name' => $faker->word,
    ];
});

//PlaceUserVirtue Factory
$factory->define(App\PlaceUserVirtue::class, function (Faker\Generator $faker) use ($factory) {

    return [
        'id_virtue' => factory(App\Virtue::class)->create()->id,
        'id_place' => factory(App\Place::class)->create()->id,
        'id_user' => factory(App\User::class)->create()->id,
    ];
});


