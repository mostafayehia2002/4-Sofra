<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration {

	public function up()
	{
		Schema::create('tokens', function(Blueprint $table) {
			$table->increments('id');
			$table->string('token');
			$table->enum('type', array('ios', 'android'));
			$table->string('tokenable_type');
			$table->integer('tokenable_id');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('tokens');
	}
}
