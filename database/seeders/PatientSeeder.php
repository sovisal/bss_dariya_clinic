<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Patient::insert([
			[
				'name_en' => 'Patient 1',
				'name_kh' => 'Patient 1',
				'phone' => '011223344',
				'date_of_birth' => '1996-01-01',
				'gender' => 1,
				'nationality' => 3,
				'created_by' => 1,
				'updated_by' => 1,
			],
			[
				'name_en' => 'Patient 2',
				'name_kh' => 'Patient 2',
				'phone' => '012345678',
				'date_of_birth' => '1995-01-01',
				'gender' => 2,
				'nationality' => 4,
				'created_by' => 1,
				'updated_by' => 1,
			],
		]);
    }
}
