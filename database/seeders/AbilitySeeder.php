<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\AbilityModule;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		AbilityModule::insert([
			['module' => 'Role'],
			['module' => 'User'],
			['module' => 'Patient'],
			['module' => 'Consultation'],
			['module' => 'Doctor'],
			['module' => 'Labor'],
			['module' => 'Echography'],
			['module' => 'X-Ray'],
			['module' => 'EGC'],
			['module' => 'LaborService'],
			['module' => 'LaborServiceCategory'],
		]);

		Ability::insert([

			[ 'ability_module_id' => '11', 'category' => 'ViewAny', 'name' => 'ViewAnyLaborService', 'label' => 'LaborService View List' ],
			[ 'ability_module_id' => '11', 'category' => 'Create', 'name' => 'CreateLaborService', 'label' => 'LaborService Create' ],
			[ 'ability_module_id' => '11', 'category' => 'Update', 'name' => 'UpdateLaborService', 'label' => 'LaborService Update' ],
			[ 'ability_module_id' => '11', 'category' => 'Delete', 'name' => 'DeleteLaborService', 'label' => 'LaborService Delete' ],

			[ 'ability_module_id' => '10', 'category' => 'ViewAny', 'name' => 'ViewAnyLaborServiceCategory', 'label' => 'LaborServiceCategory View List' ],
			[ 'ability_module_id' => '10', 'category' => 'Create', 'name' => 'CreateLaborServiceCategory', 'label' => 'LaborServiceCategory Create' ],
			[ 'ability_module_id' => '10', 'category' => 'Update', 'name' => 'UpdateLaborServiceCategory', 'label' => 'LaborServiceCategory Update' ],
			[ 'ability_module_id' => '10', 'category' => 'Delete', 'name' => 'DeleteLaborServiceCategory', 'label' => 'LaborServiceCategory Delete' ],

			[ 'ability_module_id' => '9', 'category' => 'ViewAny', 'name' => 'ViewAnyEGC', 'label' => 'EGC View List' ],
			[ 'ability_module_id' => '9', 'category' => 'Create', 'name' => 'CreateEGC', 'label' => 'EGC Create' ],
			[ 'ability_module_id' => '9', 'category' => 'Update', 'name' => 'UpdateEGC', 'label' => 'EGC Update' ],
			[ 'ability_module_id' => '9', 'category' => 'Delete', 'name' => 'DeleteEGC', 'label' => 'EGC Delete' ],

			[ 'ability_module_id' => '8', 'category' => 'ViewAny', 'name' => 'ViewAnyX-ray', 'label' => 'X-ray View List' ],
			[ 'ability_module_id' => '8', 'category' => 'Create', 'name' => 'CreateX-ray', 'label' => 'X-ray Create' ],
			[ 'ability_module_id' => '8', 'category' => 'Update', 'name' => 'UpdateX-ray', 'label' => 'X-ray Update' ],
			[ 'ability_module_id' => '8', 'category' => 'Delete', 'name' => 'DeleteX-ray', 'label' => 'X-ray Delete' ],

			[ 'ability_module_id' => '7', 'category' => 'ViewAny', 'name' => 'ViewAnyEchography', 'label' => 'Echography View List' ],
			[ 'ability_module_id' => '7', 'category' => 'Create', 'name' => 'CreateEchography', 'label' => 'Echography Create' ],
			[ 'ability_module_id' => '7', 'category' => 'Update', 'name' => 'UpdateEchography', 'label' => 'Echography Update' ],
			[ 'ability_module_id' => '7', 'category' => 'Delete', 'name' => 'DeleteEchography', 'label' => 'Echography Delete' ],

			[ 'ability_module_id' => '6', 'category' => 'ViewAny', 'name' => 'ViewAnyLabor', 'label' => 'Labor View List' ],
			[ 'ability_module_id' => '6', 'category' => 'Create', 'name' => 'CreateLabor', 'label' => 'Labor Create' ],
			[ 'ability_module_id' => '6', 'category' => 'Update', 'name' => 'UpdateLabor', 'label' => 'Labor Update' ],
			[ 'ability_module_id' => '6', 'category' => 'Delete', 'name' => 'DeleteLabor', 'label' => 'Labor Delete' ],

			[ 'ability_module_id' => '5', 'category' => 'ViewAny', 'name' => 'ViewAnyDoctor', 'label' => 'Doctor View List' ],
			[ 'ability_module_id' => '5', 'category' => 'Create', 'name' => 'CreateDoctor', 'label' => 'Doctor Create' ],
			[ 'ability_module_id' => '5', 'category' => 'Update', 'name' => 'UpdateDoctor', 'label' => 'Doctor Update' ],
			[ 'ability_module_id' => '5', 'category' => 'Delete', 'name' => 'DeleteDoctor', 'label' => 'Doctor Delete' ],

			[ 'ability_module_id' => '4', 'category' => 'ViewAny', 'name' => 'ViewAnyConsultation', 'label' => 'Consultation View List' ],
			[ 'ability_module_id' => '4', 'category' => 'Create', 'name' => 'CreateConsultation', 'label' => 'Consultation Create' ],
			[ 'ability_module_id' => '4', 'category' => 'Update', 'name' => 'UpdateConsultation', 'label' => 'Consultation Update' ],
			[ 'ability_module_id' => '4', 'category' => 'Delete', 'name' => 'DeleteConsultation', 'label' => 'Consultation Delete' ],

			[ 'ability_module_id' => '3', 'category' => 'ViewAny', 'name' => 'ViewAnyPatient', 'label' => 'Patient View List' ],
			[ 'ability_module_id' => '3', 'category' => 'Create', 'name' => 'CreatePatient', 'label' => 'Patient Create' ],
			[ 'ability_module_id' => '3', 'category' => 'Update', 'name' => 'UpdatePatient', 'label' => 'Patient Update' ],
			[ 'ability_module_id' => '3', 'category' => 'Delete', 'name' => 'DeletePatient', 'label' => 'Patient Delete' ],

			[ 'ability_module_id' => '2', 'category' => 'ViewAny', 'name' => 'ViewAnyUser', 'label' => 'User View List' ],
			[ 'ability_module_id' => '2', 'category' => 'Create', 'name' => 'CreateUser', 'label' => 'User Create' ],
			[ 'ability_module_id' => '2', 'category' => 'Update', 'name' => 'UpdateUser', 'label' => 'User Update' ],
			[ 'ability_module_id' => '2', 'category' => 'Other', 'name' => 'UpdateUserPassword', 'label' => 'User Update Password' ],
			[ 'ability_module_id' => '2', 'category' => 'Delete', 'name' => 'DeleteUser', 'label' => 'User Delete' ],
			[ 'ability_module_id' => '2', 'category' => 'Other', 'name' => 'AssignUserRole', 'label' => 'User Assign Role' ],
			[ 'ability_module_id' => '2', 'category' => 'Other', 'name' => 'AssignUserAbility', 'label' => 'User Assign Ability' ],

			[ 'ability_module_id' => '1', 'category' => 'ViewAny', 'name' => 'ViewAnyRole', 'label' => 'Role View List' ],
			[ 'ability_module_id' => '1', 'category' => 'Create', 'name' => 'CreateRole', 'label' => 'Role Create' ],
			[ 'ability_module_id' => '1', 'category' => 'Update', 'name' => 'UpdateRole', 'label' => 'Role Update' ],
			[ 'ability_module_id' => '1', 'category' => 'Delete', 'name' => 'DeleteRole', 'label' => 'Role Delete' ],
			[ 'ability_module_id' => '1', 'category' => 'Other', 'name' => 'AssignRoleAbility', 'label' => 'Role Assign Ability' ],

		]);
	}
}
