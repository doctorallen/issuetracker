<?php

use Faker\Factory as Faker;

class CreateFakeDataTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Project::truncate();
		foreach(range(1,5) as $i)
		{
			Project::create([
				'name' => $faker->company,
				'slug' => $faker->slug
			]);
		}

		User::truncate();
		foreach(range(1, 10) as $a)
		{
			User::create([
				'email' => $faker->email,
				'username' => $faker->userName,
				'password' => 'test',
				'project_id' => $faker->numberBetween(1,5),
				'permission_level' => 1
			]);

		}

		Issue::truncate();
		foreach(range(1,50) as $b)
		{
			Issue::create([
				'email' => $faker->email,
				'url' => $faker->url ,
				'type' => $faker->randomElement(['bug', 'change']),
				'steps' => $faker->paragraph ,
				'expectation' => $faker->paragraph(5),
				'browser' => $faker->userAgent,
				'actual' => $faker->paragraph(5),
				'project_id' => $faker->numberBetween(1,5),
				'status' => $faker->randomElement(['Open', 'In-Progress', 'Completed', 'Blocked']) ,
				'priority' => $faker->randomElement(['High','Medium', 'Low']), 
				'user_id' => $faker->numberBetween(1,10),

			]);
		}

		Comment::truncate();
		foreach(range(1,150) as $c)
		{
			Comment::create([
				'user_id' => $faker->numberBetween(1,10),
				'issue_id' => $faker->numberBetween(1,50),
				'comment' => $faker->paragraph,
			]);
		}

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
