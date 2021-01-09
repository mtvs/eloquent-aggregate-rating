<?php

use AggregateRating\Tests\Models\Item;
use AggregateRating\Tests\Models\Review;
use Faker\Generator;

$factory->define(Review::class, function (Generator $faker) {
	return [
		'item_id' => function () {
			return factory(Item::class)->create();
		},
		'rating' => $faker->numberBetween(1, 5),
	];
});