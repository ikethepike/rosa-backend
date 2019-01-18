<?php

use Faker\Generator as Faker;

$factory->define(Rosa\Lesson::class, function (Faker $faker) {
    return [
        'masthead' => $faker->imageUrl(),
        'title'    => $faker->sentence(),
        'text'     => $faker->text(),
    ];
});
