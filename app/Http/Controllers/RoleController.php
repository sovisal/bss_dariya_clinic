<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Ability;
use Illuminate\Http\Request;
use App\Models\AbilityModule;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data = [
			'roles' => Role::orderBy('label', 'asc')->orderBy('name', 'asc')->get()
		];
		return view('role.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('role.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(RoleRequest $request)
	{
		$role = Role::create($request->only(['name', 'label']));
		$url = route('user.role.index');
		if ($request->save_opt == 'save_create') {
			$url = route('user.role.create');
		}else if($request->save_opt == 'save_edit'){
			$url = route('user.role.edit', $role->id);
		}
		return redirect($url)->with('success', __('alert.message.success.crud.create'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function ability(Role $role)
	{
		$data = [
			'role' => $role,
			'ability_modules' => AbilityModule::with([
					'abilities' => function ($query){
						$query->orderBy('category', 'asc');
					},
				])
				->orderBy('module', 'asc')
				->get()
			];
		return view('role.ability', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function assign_ability(Request $request, Role $role)
	{
		// dd($request->all());
		$role->allowTo($request->ability);
		return back()->with('success', __('alert.message.success.crud.update'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Role $role)
	{
		$data = [
			'role' => $role
		];
		return view('role.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(RoleRequest $request, Role $role)
	{
		if ($role->update($request->only(['name', 'label']))) {
			return back()->with('success', __('alert.message.success.crud.update'));
		}
		return back()->with('error', __('alert.message.error.crud.update'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Role $role)
	{
		if ($role->delete()) {
			return back()->with('success', __('alert.message.success.crud.delete'));
		}
		return back()->with('error', __('alert.message.error.crud.delete'));
	}
}
