<?php

use \Faker\Generator;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\pschocke\FeedbackModal\AnonymousFeedback::class, function (Generator $faker) {
    return [
        'email' => $faker->safeEmail,
        'type' => 'like',
        'feedback' => $faker->paragraph,
        'url' => $faker->url
    ];
});
