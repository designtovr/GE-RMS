<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
        	$table->string('name');
        });

        DB::table('roles')->insert(
            array(
                'id' => 1,
                'name' => 'Admin',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('roles');
    }
}