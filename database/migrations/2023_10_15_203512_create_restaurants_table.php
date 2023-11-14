<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('email')->unique();
            $table->integer('region_id')->unsigned();
			$table->string('password');
			$table->float('minimum_charger')->default(0);
			$table->float('delivery_cost')->default(0);
            $table->string('phone',20)->unique();
			$table->string('whatsapp', 20);
			$table->string('image');
			$table->enum('status', array('open', 'closed'));
			$table->string('remember_me', 100)->nullable();
			$table->string('api_token', 100);
			$table->string('code', 6)->nullable();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
