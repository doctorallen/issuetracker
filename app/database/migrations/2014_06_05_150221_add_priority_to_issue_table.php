<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriorityToIssueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('issues', function(Blueprint $table)
		{
			$table->enum('priority', array('High', 'Medium', 'Low'))->default('Low');
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
			$table->dropColumn('priority');
		});
	}

}
