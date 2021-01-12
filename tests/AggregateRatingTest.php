<?php

namespace AggregateRating\Tests;

use AggregateRating\Tests\Models\Item;
use AggregateRating\Tests\Models\Review;

class AggregateRatingTest extends TestCase
{
	/**
	 * @test
	 */
	public function aggregate_rating_values_are_up_to_date_with_the_ratings()
	{
		$item = factory(Item::class)->create();

		$reviews = $item->reviews()->saveMany([
			factory(Review::class)->make(['rating' => 5]),
			factory(Review::class)->make(['rating' => 1]),
		]);

		$item->refresh();

		$this->assertEquals(3, $item->rating_average);
		$this->assertEquals(2, $item->rating_count);

		$reviews[1]->delete();

		$item->refresh();

		$this->assertEquals(5, $item->rating_average);
		$this->assertEquals(1, $item->rating_count);	
	}
}