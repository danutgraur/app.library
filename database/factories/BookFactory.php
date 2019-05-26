<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->realText(rand(10, 300)),
        'cover_image' => null,
        'author_id' => factory('App\Author')->create()->id,
    ];
});
