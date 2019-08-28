<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMasterTable extends Migration
{
	public function up()
	{
		Schema::create('ma_product', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('part_no', 15);
			$table->string('description', 50);
			$table->bigInteger('type');
			$table->tinyInteger('created_by');
			$table->tinyInteger('updated_by');
			$table->timestamps();
		});
	}

	public function down()
	{
		
	}
}