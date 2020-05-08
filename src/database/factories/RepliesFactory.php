<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Questions;
use App\Model\Replies;
use App\User;
use Faker\Generator as Faker;

$factory->define(Replies::class, function (Faker $faker) {
    return [
        'body' => $faker->text,
        'question_id' => function () {
            return Questions::all()->random();
        },
        'user_id' => function () {
            return User::all()->random();
        }
    ];
});
