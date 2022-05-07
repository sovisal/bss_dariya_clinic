<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call([
			AbilitySeeder::class,
			RoleSeeder::class,
			UserSeeder::class,
			SettingSeeder::class,
			DoctorSeeder::class,
			MedicineSeeder::class,
			PatientSeeder::class,
		]);
		\App\Models\User::factory(10)->create();
	}
}
