<?php

use Faker\Generator as Faker;

$factory->define(Rosa\Suggestion::class, function (Faker $faker) {
    return [
        'idea'    => $faker->text(),
        'user_id' => mt_rand(0, Rosa\User::count()),
    ];
});
