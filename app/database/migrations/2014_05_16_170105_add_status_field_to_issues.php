<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusFieldToIssues extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('issues', function(Blueprint $table)
		{
			$table->enum('status', array('Blocked', 'In-Progress','Open', 'Completed'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('issues', function(Blueprint $table)
		{
			$table->dropColumn('status');
		});
	}

}
