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
        'type_id' => factory(App\PlaceType::class)->create()->id,
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
    ];
});

//Visit Factory
$factory->define(App\Visit::class, function (Faker\Generator $faker) use ($factory) {

    return [
        'user_id' => factory(App\User::class)->create()->id,
        'place_id' => factory(App\Place::class)->create()->id,
        'date' => $faker->year.'-'.$faker->month.'-'.$faker->dayOfMonth,
    ];
});

//Note Factory
$factory->define(App\Note::class, function (Faker\Generator $faker) use ($factory) {

    $n_price = $faker->randomFloat(1, 0, 20);
    $n_quality = $faker->randomFloat(1, 0, 20);
    $n_quantity = $faker->randomFloat(1, 0, 20);
    $n_ambiance = $faker->randomFloat(1, 0, 20);

    return [
        'visit_id' => factory(App\Visit::class)->create()->id,
        'n_price' => $n_price,
        'n_quantity' => $n_quantity,
        'n_quality' => $n_quality,
        'n_ambiance' => $n_ambiance,
        'average' => array_sum([$n_price, $n_quantity, $n_quality, $n_ambiance])/4
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
        'virtue_id' => factory(App\Virtue::class)->create()->id,
        'place_id' => factory(App\Place::class)->create()->id,
        'user_id' => factory(App\User::class)->create()->id,
    ];
});



