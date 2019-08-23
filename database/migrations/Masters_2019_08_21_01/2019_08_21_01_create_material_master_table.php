<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialMasterTable extends Migration
{
	public function up()
	{
		Schema::create('ma_material', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('part_no', 15);
			$table->string('description', 50);
			$table->tinyInteger('created_by');
			$table->tinyInteger('updated_by');
			$table->timestamps();
		});
	}

	public function down()
	{
		//Schema::dropIfExists('ma_material');
	}
}