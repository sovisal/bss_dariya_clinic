<?php

namespace App\View\Components;

use App\Models\Setting;
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
					'patient' => [
						'can' => 'ViewAnyPatient',
						'url' => route('patient.index'),
						'name' => ['index', 'create', 'edit', 'show'],
						'label' => 'Patient',
					],
					'consultation' => [
						'can' => 'ViewAnyConsultation',
						'url' => route('patient.consultation.index'),
						'name' => ['index', 'create'],
						'label' => 'Consulting',
					],
				],

			],
			

			'para_clinic' => [
				'can' => 'ViewAnyParaClinic',
				'url' => route('para_clinic.index'),
				'label' => 'Para Clinic',
				
				'sub' => [
					'labor' => [
						'can' => 'ViewAnyLabor',
						'url' => route('para_clinic.labor.index'),
						'name' => ['index', 'create', 'edit', 'show'],
						'label' => 'Labor',
					],
					'echography' => [
						'can' => 'ViewAnyEchography',
						'url' => route('para_clinic.echography.index'),
						'name' => ['index', 'create', 'edit', 'show'],
						'label' => 'Echography',
					],
					'x_ray' => [
						'can' => 'ViewAnyX-Ray',
						'url' => route('para_clinic.x_ray.index'),
						'name' => ['index', 'create', 'edit', 'show'],
						'label' => 'X-Ray',
					],
				],
			],

			'user' => [
				'can' => 'ViewAnyUser',
				'url' => route('user.index'),
				'label' => 'User Managment',
				'sub' => [
					'user' => [
						'can' => 'ViewAnyUser',
						'url' => route('user.index'),
						'name' => ['index','create', 'edit', 'ability'],
						'label' => 'User',
					],
					'role' => [
						'can' => 'ViewAnyRole',
						'url' => route('user.role.index'),
						'name' => ['index','create', 'edit', 'ability'],
						'label' => 'Role',
					],
					'ability' => [
						'can' => 'ViewAnyAbility',
						'url' => route('user.ability.index'),
						'name' => ['index','create', 'edit'],
						'label' => 'Ability',
					],
				],
			],

			'setting' => [
				'can' => 'DeveloperMode',
				'url' => route('setting.edit'),
				'label' => 'Setting',
				
				'sub' => [
					'setting' => [
						'can' => 'UpdateSetting',
						'url' => route('setting.edit'),
						'name' => ['edit'],
						'label' => 'Setting',
					],
					'address' => [
						'can' => 'UpdateSetting', // not yet create abilities
						'url' => route('setting.address.index'),
						'name' => ['index','create', 'edit'],
						'label' => 'Address',
					],
				],
			],
		];
		$setting = Setting::first();
		if (!$setting) {
			$setting = Setting::Create([
									'clinic_name_kh' => 'Clinic KH',
									'clinic_name_en' => 'Clinic EN',
									'sign_name_kh' => 'Name KH',
									'sign_name_en' => 'Name EN',
									'phone' => 'Phone',
									'address' => 'Address',
									'description' => 'Description',
								]);
		}

		return view('layouts.app', compact('menu', 'setting'));
	}
}
