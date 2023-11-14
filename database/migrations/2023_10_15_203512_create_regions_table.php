<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration {

	public function up()
	{
		Schema::create('regions', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('city_id')->unsigned();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('regions');
	}
}
