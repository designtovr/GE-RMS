<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerLocationTransactionTable extends Migration
{
	public function up()
	{
		Schema::create('ma_customer_location_trans', function(Blueprint $table)
		{
			$table->bigInteger('customer_id');
			$table->bigInteger('location_id');
			$table->foreign('customer_id')->references('id')->on('ma_customer');
			$table->foreign('location_id')->references('id')->on('ma_location');
			$table->tinyInteger('created_by');
			$table->tinyInteger('updated_by');
			$table->timestamps();
		});
	}

	public function down()
	{
		
	}
}