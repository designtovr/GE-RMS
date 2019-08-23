<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
	public function up()
	{
		Schema::create('role_user', function(Blueprint $table)
		{
			$table->bigInteger('user_id')->unsigned();
		    $table->integer('role_id')->unsigned();
		    $table->foreign('user_id')
		        ->references('id')->on('users');
		    $table->foreign('role_id')
		        ->references('id')->on('roles');
		});
		DB::table('role_user')->insert(
            array(
                'user_id' => 1,
                'role_id' => 1
            )
        );
	}

	public function down()
	{
		//Schema::dropIfExists('role_user');
	}
}