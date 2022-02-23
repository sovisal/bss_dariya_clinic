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

			'user' => [
				'can' => 'ViewAnyUser',
				'url' => route('user.index'),
				'label' => 'User',

				'sub' => [
					[
						'can' => 'ViewAnyUser',
						'url' => route('user.index'),
						'name' => 'index',
						'label' => 'User List',
					],
					[
						'can' => 'CreateUser',
						'url' => route('user.create'),
						'name' => 'create',
						'label' => 'Create',
					],
				],
			],
			
			'role' => [
				'can' => 'ViewAnyRole',
				'url' => route('role.index'),
				'label' => 'Role',
				'sub' => [
					[
						'can' => 'ViewAnyRole',
						'url' => route('role.index'),
						'name' => 'index',
						'label' => 'Role List',
					],
					[
						'can' => 'CreateRole',
						'url' => route('role.create'),
						'name' => 'create',
						'label' => 'Create',
					],
				],
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
			]
		];

		return view('layouts.app', compact('menu'));
	}
}
