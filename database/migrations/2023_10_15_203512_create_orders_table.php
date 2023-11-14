<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned();
            $table->integer('restaurant_id')->unsigned();
			$table->float('cost')->default(0);
			$table->float('delivary_cost')->default(0);
			$table->float('total_cost')->default(0);
			$table->integer('payment_type_id')->unsigned();
			$table->enum('status', array('pending', 'accepted', 'rejected', 'delivered'));
			$table->string('address');
			$table->float('commission')->default(0);
            $table->boolean('confirm')->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
