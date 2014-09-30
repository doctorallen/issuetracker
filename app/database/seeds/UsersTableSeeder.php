<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		User::truncate();
		User::create([
			'email' => 'admin@example.com',
			'username' => 'admin',
			'password' => 'admin',
			'permission_level' => 0,
			'project_id' => 2,
		]);

		User::create([
			'email' => 'client@client.com',
			'username' => 'client',
			'password' => 'client',
			'permission_level' => 1,
			'project_id' => 3,
		]);
	}

}
