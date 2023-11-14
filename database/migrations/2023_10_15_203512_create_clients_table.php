<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('phone', 20)->unique();
			$table->string('password');
			$table->integer('region_id')->unsigned();
			$table->string('image');
			$table->string('remember_me', 100)->nullable();
			$table->string('api_token', 100);
			$table->string('code', 6)->nullable();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
