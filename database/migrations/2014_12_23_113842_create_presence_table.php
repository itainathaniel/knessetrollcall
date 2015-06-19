<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePresenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('presences', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('knessetmember_id');
            $table->date('day');
            $table->float('work');
			$table->timestamps();
            $table->unique(array('knessetmember_id', 'day'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('presences');
	}

}
