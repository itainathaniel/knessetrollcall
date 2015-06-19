<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnessetmembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('knessetmembers', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('knesset_id')->unique();
            $table->string('party_id');
            $table->string('name');
            $table->boolean('isInside');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('knessetmembers');
	}

}
