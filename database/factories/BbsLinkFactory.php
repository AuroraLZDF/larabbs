<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Bbs\Link::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'link' => $faker->url,
    ];
});
