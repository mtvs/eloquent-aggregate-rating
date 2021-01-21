# Ratings Aggregation for The Laravel Eloquent Model

This package aggregates the ratings' average and count of a model, which is 
reviewed, and updates the model on the occurance of the specified events, e.g.:
after saving or deleting a review. So, it facilitates the access to these values
and eleiminates the problem of n+1 queries when retrieving a list of the models
with their aggregate-rating values.

## Setup

First, modify the database table of the model that is reviewed and add two
new columns, one to store the ratings' average and another one for the ratings'
count, forexample:

```php

	$table->float('rating_average')->nullable();
	$table->unsignedInteger('rating_count')->default(0);

```

Obviously, there has to be a `rating` column on the reviews table.

Then, there're two traits. One is intended to be used in the model that is 
reviewed. It contains an abstract method that has to be implemented to return
the relationship to the review model.

```php

use AggregateRating\HasAggregateRating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany

Class Item extends Model
{
	use HasAggregateRating;

	public function aggregateRatingReviews(): HasMany
	{
		return $this->reviews();
	}

	// ...
}

```

The other is to be used in the review model. It contains an abstract method to
return the relationship to the model that is reviewed.

```php

use AggregateRating\HasIndividualRating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

Class Review extends Model
{
	use HasIndividualRating;

	public function aggregateRatingItem(): BelongsTo
	{
		return $this->item();
	}

	// ...
}

```

### Triggering Events

The `aggregateRatingEvents()`, which is on the `HasIndividualRating` trait,
returns the events on the review model that trigger the process of the aggregation
and updating the related model. This method's default definition is as the
following:

```php

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

```

But you can overwrite it to spicify your custom events:

```php

	/**
     * Return the model events that require updating the aggregate rating.
     *
     * @return array
     */
	protected static function aggregateRatingEvents()
	{ 
		return [
			'approved', 'suspended', 'rejected', 'deleted',
		];
	}

```

### Customizing The Column Names

If you want to choose other names for your columns, set the following 
constants on your models to the corresponding values.

```php

use AggregateRating\HasAggregateRating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany

Class Item extends Model
{
	use HasAggregateRating;

	const RATING_AVERAGE = 'rating_average';
	const RATING_COUNT = 'rating_count';

	public function aggregateRatingReviews(): HasMany
	{
		return $this->reviews();
	}

	// ...
}

```

```php

use AggregateRating\HasIndividualRating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

Class Review extends Model
{
	use HasIndividualRating;

	const RATING = 'rating';

	public function aggregateRatingItem(): BelongsTo
	{
		return $this->item();
	}

	// ...
}

```
