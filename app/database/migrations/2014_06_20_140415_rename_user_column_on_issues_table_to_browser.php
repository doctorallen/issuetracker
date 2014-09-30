<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameUserColumnOnIssuesTableToBrowser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('issues', function(Blueprint $table)
		{
			$table->dropColumn('user');
			$table->text('browser');
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
			$table->dropColumn('browser');
			$table->text('user');
		});
	}

}
