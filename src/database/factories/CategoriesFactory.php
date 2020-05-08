<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Categories;
use Faker\Generator as Faker;

$factory->define(Categories::class, function (Faker $faker) {
    $word = $faker->word;//randomly generated word by Laravel
    return [ 
        'name' => $word,
        'slug' => str_slug($word)
    ];
});
