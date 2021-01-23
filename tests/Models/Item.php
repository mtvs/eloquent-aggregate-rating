<?php

namespace AggregateRating\Tests\Models;

use AggregateRating\HasAggregateRating;
use AggregateRating\Tests\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
	use HasAggregateRating;

	public function aggregateRatingReviews(): HasMany
	{
		return $this->reviews();
	}

	public function reviews()
	{
		return $this->hasMany(Review::class);
	}
}