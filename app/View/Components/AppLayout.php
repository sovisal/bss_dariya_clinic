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
			// 'home' => [
			// 	'can' => '',
			// 	'url' => route('home'),
			// 	'label' => 'Home',
			// ],

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
						// 'url' => route('patient.consultation.index'),
						'url' => route('patient.index'),
						'name' => ['index', 'create', 'edit', 'show'],
						'label' => 'Consulting',
					],
				],

			],

			'prescription' => [
				'can' => 'ViewAnyPrescription',
				'url' => route('prescription.index'),
				'label' => 'Prescription',
				'sub' => [
					'prescription' => [
						'can' => 'ViewAnyPrescription',
						'url' => route('prescription.index'),
						'name' => ['index', 'create', 'edit', 'show'],
						'label' => 'Prescription List',
					],
				],
			],

			'para_clinic' => [
				'can' => 'ViewAnyParaClinic',
				'url' => route('para_clinic.labor.index'),
				'label' => 'Para Clinic',

				'sub' => [
					'labor' => [
						'can' => 'ViewAnyLabor',
						'url' => route('para_clinic.labor.index'),
						'name' => ['index', 'create', 'edit', 'show'],
						'label' => 'Labor',
					],
					'xray' => [
						'can' => 'ViewAnyXRay',
						'url' => route('para_clinic.xray.index'),
						'name' => ['index', 'create', 'edit', 'show'],
						'label' => 'X-Ray',
					],
					'echography' => [
						'can' => 'ViewAnyEchography',
						'url' => route('para_clinic.echography.index'),
						'name' => ['index', 'create', 'edit', 'show'],
						'label' => 'Echography',
					],
					'ecg' => [
						'can' => 'ViewAnyECG',
						'url' => route('para_clinic.ecg.index'),
						'name' => ['index', 'create', 'edit', 'show'],
						'label' => 'ECG',
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
					'labor-item' => [
						'can' => 'UpdateSetting',
						'url' => route('setting.labor-item.index'),
						'name' => ['index', 'create', 'edit'],
						'label' => 'Labor Template',
					],
					'echo-type' => [
						'can' => 'UpdateSetting',
						'url' => route('setting.echo-type.index'),
						'name' => ['index', 'create', 'edit'],
						'label' => 'Echo Template',
					],
					'ecg-type' => [
						'can' => 'UpdateSetting',
						'url' => route('setting.ecg-type.index'),
						'name' => ['index', 'create', 'edit'],
						'label' => 'ECG Template',
					],
					'xray-type' => [
						'can' => 'UpdateSetting',
						'url' => route('setting.xray-type.index'),
						'name' => ['index', 'create', 'edit'],
						'label' => 'Xray Template',
					],
					'data-parent' => [
						'can' => 'UpdateSetting',
						'url' => route('setting.data-parent.index'),
						'name' => ['index', 'create', 'edit'],
						'label' => 'Data Selection',
					],
					'doctor' => [
						'can' => 'ViewAnyDoctor',
						'url' => route('setting.doctor.index'),
						'name' => ['index', 'create', 'edit'],
						'label' => 'Doctor',
					],
					'medicine' => [
						'can' => 'ViewAnyMedicine',
						'url' => route('setting.medicine.index'),
						'name' => ['index', 'create', 'edit'],
						'label' => 'Medicine',
					],
					'address' => [
						'can' => 'UpdateSetting', // not yet create abilities
						'url' => route('setting.address.index'),
						'name' => ['index', 'create', 'edit'],
						'label' => 'Address',
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
						'name' => ['index', 'create', 'edit', 'ability'],
						'label' => 'User',
					],
					'role' => [
						'can' => 'ViewAnyRole',
						'url' => route('user.role.index'),
						'name' => ['index', 'create', 'edit', 'ability'],
						'label' => 'Role',
					],
					'ability' => [
						'can' => 'ViewAnyAbility',
						'url' => route('user.ability.index'),
						'name' => ['index', 'create', 'edit'],
						'label' => 'Ability',
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
