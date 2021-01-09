<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
	public function up()
	{
		Schema::create('ratings', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->unsignedBigInteger('item_id');
			$table->tinyInteger('value');
		});
	}

	public function down()
	{
		Schema::dropIfExists('ratings');
	}
}