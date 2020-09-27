<?php

namespace AggregateRating\Tests\Models;

use AggregateRating\Tests\Models\Rating;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	public function ratings()
	{
		return $this->hasMany(Rating::class);
	}
}