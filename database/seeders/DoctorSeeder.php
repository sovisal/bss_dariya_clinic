<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Doctor::insert([
			[
				'name_kh' => 'គ្រួគ ពុទ្ធា',
				'name_en' => 'Krouk Puthea',
				'created_by' => 1,
				'updated_by' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'name_kh' => 'Doctor 2',
				'name_en' => 'Doctor 2',
				'created_by' => 1,
				'updated_by' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'name_kh' => 'Doctor 3',
				'name_en' => 'Doctor 3',
				'created_by' => 1,
				'updated_by' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			],
		]);
    }
}
