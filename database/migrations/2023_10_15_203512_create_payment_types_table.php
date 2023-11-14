<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTypesTable extends Migration {

	public function up()
	{
		Schema::create('payment_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('payment_types');
	}
}
