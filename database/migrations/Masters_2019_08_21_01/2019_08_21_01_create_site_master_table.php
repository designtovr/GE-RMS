<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteMasterTable extends Migration
{
	public function up()
	{
		Schema::create('ma_site', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('code', 15);
			$table->string('name', 20);
			$table->tinyInteger('created_by');
			$table->tinyInteger('updated_by');
			$table->timestamps();
		});
	}

	public function down()
	{
		//Schema::dropIfExists('ma_site');
	}
}