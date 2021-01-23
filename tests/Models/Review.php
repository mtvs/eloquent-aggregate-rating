<?php

namespace AggregateRating\Tests\Models;

use AggregateRating\HasIndividualRating;
use AggregateRating\Tests\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
	use HasIndividualRating;

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function aggregateRatingItem(): BelongsTo
	{
		return $this->item();
	}
}