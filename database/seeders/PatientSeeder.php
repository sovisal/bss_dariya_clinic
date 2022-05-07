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
				'name_kh' => 'Patient 1',
				'created_by' => 1,
				'updated_by' => 1,
			],
			[
				'name_kh' => 'Patient 2',
				'created_by' => 1,
				'updated_by' => 1,
			],
		]);
    }
}
