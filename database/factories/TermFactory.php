<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Rosa\Term::class, function (Faker $faker) {
    $date = Carbon::now();
    $date->addWeeks(12);

    return [
        'ends_at' => $date->endOfWeek(),
    ];
});
