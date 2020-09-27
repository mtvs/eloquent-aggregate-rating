<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
	public function up()
	{
		Schema::create('items', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->float('rating_average')->nullable();
			$table->unsignedInteger('rating_count')->default(0);
		});
	}

	public function down()
	{
		Schema::dropIfExists('items');
	}
}