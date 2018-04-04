<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'type' => $faker->randomElement(['sport' ,'culture', 'other']),
        'name' => $faker->word ,
        'description' =>  $faker->text,
        'contact' => $faker->phoneNumber,
        'venue' => $faker->city,
    ];
});
