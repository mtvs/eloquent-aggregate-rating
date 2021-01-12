<?php

namespace AggregateRating;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasAggregateRating
{
	/**
	 * Update the aggregate-rating values.
	 * 
	 * @return void
	 */
	public function updateAggregateRating()
	{
		$this->{$this->getRatingAverageColumn()} = $this->aggregateRatingReviews()
			->avg($this->getReviewRatingColumn());

		$this->{$this->getRatingCountColumn()} = $this->aggregateRatingReviews()
			->count($this->getReviewRatingColumn());

		$this->getQuery()
            ->where($this->getKeyName(), $this->getKey())
            ->update([
                $this->getRatingAverageColumn() => $this->{$this->getRatingAverageColumn()},
                $this->getRatingCountColumn() => $this->{$this->getRatingCountColumn()},
            ]);
	}

	/**
	 * Get the name of rating-average column
	 *
	 * @return string
	 */
	public function getRatingAverageColumn()
	{
		return defined('static::RATING_AVERAGE') ? static::RATING_AVERAGE : 'rating_average';
	}

	/**
	 * Get the name of rating-count column
	 *
	 * @return string
	 */
	public function getRatingCountColumn()
	{
		return defined('static::RATING_COUNT') ? static::RATING_COUNT : 'rating_count';
	}	

	/**
	 * Get the name of rating column on the review model
	 *
	 * @return string
	 */
	public function getReviewRatingColumn()
	{
		return $this->aggregateRatingReviews()->getRelated()->getRatingColumn();
	}

	/**
	 * Return the relationship to the related reviews
	 *
	 * @return HasMany
	 */
	abstract public function aggregateRatingReviews(): HasMany;
}