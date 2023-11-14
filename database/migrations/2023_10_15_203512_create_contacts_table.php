<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone', 20);
			$table->text('message');
			$table->enum('type', array('complaint', 'suggestion', 'enquiry'));
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}
