<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
	/**
	 * Get the view / contents that represents the component.
	 *
	 * @return \Illuminate\View\View
	 */
	public function render()
	{

		$menu = [
			'home' => [
				'can' => '',
				'url' => route('home'),
				'label' => 'Home',
			],

			'patient' => [
				'can' => 'ViewAnyPatient',
				'url' => route('patient.index'),
				'label' => 'Patient',

				'sub' => [
					[
						'can' => 'ViewAnyPatient',
						'url' => route('patient.index'),
						'name' => ['index', 'create'],
						'label' => 'Patient',
					],
					[
						'can' => 'ViewAnyConsulting',
						'url' => route('patient.consulting'),
						'name' => 'consulting',
						'label' => 'Consulting',
					],
				],

			],

			'user' => [
				'can' => 'ViewAnyUser',
				'url' => route('user.index'),
				'label' => 'User',
			],
			
			'role' => [
				'can' => 'ViewAnyRole',
				'url' => route('role.index'),
				'label' => 'Role',
			],

			'ability' => [
				'can' => 'ViewAnyAbility',
				'url' => route('ability.index'),
				'label' => 'Ability',

				'sub' => [
					[
						'can' => 'ViewAnyAbility',
						'url' => route('ability.index'),
						'name' => 'index',
						'label' => 'Ability List',
					],
					[
						'can' => 'CreateAbility',
						'url' => route('ability.create'),
						'name' => 'create',
						'label' => 'Create',
					],
				]
			],

			'address' => [
				'can' => 'UpdateSetting', // not yet create abilities
				'url' => route('address.index'),
				'label' => 'Address',
			],

			'setting' => [
				'can' => 'UpdateSetting',
				'url' => route('setting.edit'),
				'label' => 'Setting',
			],
		];

		return view('layouts.app', compact('menu'));
	}
}
