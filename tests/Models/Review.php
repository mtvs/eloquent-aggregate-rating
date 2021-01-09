<?php

namespace AggregateRating\Tests\Models;

use AggregateRating\Tests\Models\Item;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	public function item()
	{
		return $this->belongsTo(Item::class);
	}
}