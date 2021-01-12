<?php

namespace AggregateRating;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasIndividualRating
{		
	/**
     * Boot the trait.
     *
     * @return void
     */
	public static function bootHasIndividualRating()
	{
		static::registerAggregateRatingEvents();
	}

	/**
     * Register a listener to handle the aggregate-rating events for a model.
     *
     * @return void
     */
	protected static function registerAggregateRatingEvents()
	{
		foreach (static::aggregateRatingEvents() as $event) {
			static::registerModelEvent($event, function ($model) {
				static::updateAggregateRatingItem($model);
			});
		}
	}

	/**
     * Return the model events that require updating the aggregate rating.
     *
     * @return array
     */
	protected static function aggregateRatingEvents()
	{ 
		return [
			'saved', 'deleted',
		];
	}

	/**
     * Update the aggregate rating on the item that the review model belongs to.
     *
     * @return void
     */
	protected static function updateAggregateRatingItem($model) 
	{
		$model->aggregateRatingItem->updateAggregateRating();
	}

	/**
     * Get the name of the rating column.
     *
     * @return string
     */
	public function getRatingColumn()
	{
		return defined('static::RATING') ? static::RATING : 'rating';
	}

	/**
     * Return the relationship to the item that the review model belongs to.
     *
     * @return BelongsTo
     */
	abstract public function aggregateRatingItem(): BelongsTo;
}