<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Setting::firstOrCreate([
			'id' => 1,
			'clinic_name_kh' => 'Clinic KH',
			'clinic_name_en' => 'Clinic EN',
			'sign_name_kh' => 'Name KH',
			'sign_name_en' => 'Name EN',
			'phone' => 'Phone',
			'address' => 'Address',
			'description' => 'Description',
		]);
	}
}
