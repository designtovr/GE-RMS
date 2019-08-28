<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerSiteTransactionTable extends Migration
{
	public function up()
	{
		Schema::create('ma_customer_site_trans', function(Blueprint $table)
		{
			$table->bigInteger('customer_id');
			$table->bigInteger('site_id');
			$table->foreign('customer_id')->references('id')->on('ma_customer');
			$table->foreign('site_id')->references('id')->on('ma_site');
			$table->tinyInteger('created_by');
			$table->tinyInteger('updated_by');
			$table->timestamps();
		});
	}

	public function down()
	{
		
	}
}