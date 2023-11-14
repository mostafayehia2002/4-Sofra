<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->float('price');
			$table->float('price_offer');
			$table->integer('processing_time');
			$table->string('image');
			$table->integer('restaurant_id')->unsigned();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
