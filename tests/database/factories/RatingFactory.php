<?php

use AggregateRating\Tests\Models\Item;
use AggregateRating\Tests\Models\Rating;
use Faker\Generator;

$factory->define(Rating::class, function (Generator $faker) {
	return [
		'item_id' => function () {
			return factory(Item::class)->create();
		},
		'value' => $faker->numberBetween(1, 5),
	];
});