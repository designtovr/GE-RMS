<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerMasterTable extends Migration
{
	public function up()
	{
		Schema::create('ma_customer', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('code', 15);
			$table->string('name', 25);
			$table->string('address', 100);
			$table->string('contact_person', 25);
			$table->string('email', 25);
			$table->string('tin', 10);
			$table->string('contact', 20);
			$table->tinyInteger('created_by');
			$table->tinyInteger('updated_by');
			$table->timestamps();
		});
	}

	public function down()
	{
		//Schema::dropIfExists('ma_customer');
	}
}