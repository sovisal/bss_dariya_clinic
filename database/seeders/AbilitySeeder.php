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
		]);

		Ability::insert([

			[ 'ability_module_id' => '1', 'category' => 'ViewAny', 'name' => 'ViewAnyRole', 'label' => 'Role View List' ],
			[ 'ability_module_id' => '1', 'category' => 'Create', 'name' => 'CreateRole', 'label' => 'Role Create' ],
			[ 'ability_module_id' => '1', 'category' => 'Update', 'name' => 'UpdateRole', 'label' => 'Role Update' ],
			[ 'ability_module_id' => '1', 'category' => 'Delete', 'name' => 'DeleteRole', 'label' => 'Role Delete' ],
			[ 'ability_module_id' => '1', 'category' => 'Other', 'name' => 'AssignRoleAbility', 'label' => 'Role Assign Ability' ],

			[ 'ability_module_id' => '2', 'category' => 'ViewAny', 'name' => 'ViewAnyUser', 'label' => 'User View List' ],
			[ 'ability_module_id' => '2', 'category' => 'Create', 'name' => 'CreateUser', 'label' => 'User Create' ],
			[ 'ability_module_id' => '2', 'category' => 'Update', 'name' => 'UpdateUser', 'label' => 'User Update' ],
			[ 'ability_module_id' => '2', 'category' => 'Other', 'name' => 'UpdateUserPassword', 'label' => 'User Update Password' ],
			[ 'ability_module_id' => '2', 'category' => 'Delete', 'name' => 'DeleteUser', 'label' => 'User Delete' ],
			[ 'ability_module_id' => '2', 'category' => 'Other', 'name' => 'AssignUserRole', 'label' => 'User Assign Role' ],
			[ 'ability_module_id' => '2', 'category' => 'Other', 'name' => 'AssignUserAbility', 'label' => 'User Assign Ability' ],

		]);
	}
}
