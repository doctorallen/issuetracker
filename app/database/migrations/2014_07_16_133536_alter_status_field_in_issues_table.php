<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStatusFieldInIssuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement("ALTER TABLE issues CHANGE status status ENUM('Blocked', 'In-Progress', 'Open', 'Completed', 'Closed')");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement("ALTER TABLE issues CHANGE status status ENUM('Blocked', 'In-Progress', 'Open', 'Completed')");
	}

}
