<?php

namespace AggregateRating\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
	protected function setup(): void
	{
		parent::setup();

		$this->withoutExceptionHandling();
		
		$this->loadMigrationsFrom(__DIR__.'/database/migrations');

		$this->withFactories(__DIR__.'/database/factories');
	}
}
