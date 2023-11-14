<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 100);
			$table->text('content');
			$table->boolean('is_read')->default(0);
			$table->integer('order_id')->unsigned();
			$table->string('notificationable_type');
			$table->integer('notificationable_id');
            $table->timestamps();
		});
	}
	public function down()
	{
		Schema::drop('notifications');
	}
}
