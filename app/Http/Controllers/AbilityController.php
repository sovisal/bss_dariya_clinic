<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use Illuminate\Http\Request;
use App\Models\AbilityModule;
use App\Http\Controllers\Controller;
use App\Http\Requests\AbilityRequest;

class AbilityController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data = [
			'ability_modules' => AbilityModule::orderBy('module', 'asc')->get()
		];
		return view('ability.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('ability.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(AbilityRequest $request)
	{
		$ability_module = AbilityModule::create([
			'module' => $request->module,
		]);

		foreach ($request->category as $key => $category) {
			Ability::create([
				'name' => $request->name[$key],
				'label' => $request->label[$key],
				'category' => $category,
				'ability_module_id' => $ability_module->id,
			]);
		}
		$url = route('user.ability.index');
		if ($request->save_opt == 'save_create') {
			$url = route('user.ability.create');
		}else if($request->save_opt == 'save_edit'){
			$url = route('user.ability.edit', $ability_module->id);
		}
		return redirect($url)->with('success', __('alert.message.success.crud.create'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function show(Request $request)
	{
		$ability_module = AbilityModule::find($request->id);
		if ($ability_module) {
			$tbody = '';
			foreach ($ability_module->abilities as $key => $ability) {
				$tbody .= '<tr>
							<td class="text-center">'. ++$key .'</td>
							<td>'. $ability->category .'</td>
							<td>'. $ability->name .'</td>
							<td>'. $ability->label .'</td>
						</tr>';
			}
			return response()->json([
				'success' => true,
				'ability_module' => $ability_module,
				'tbody' => $tbody,
				'url' => route('user.ability.edit', $ability_module->id),
			]);
		}
		return response()->json([
			'success' => false,
			'message' => __('alert.message.error.data_not_found'),
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(AbilityModule $ability_module)
	{
		$data = [
			'ability_module' => $ability_module
		];
		return view('ability.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(AbilityRequest $request, AbilityModule $ability_module)
	{
		$ability_module->update([
			'module' => $request->module,
		]);

		// Delete Removed Ability
		$removed_abilities = Ability::where('ability_module_id', $ability_module->id)->whereNotIn('id', $request->old_ability_id)->get();
		foreach ($removed_abilities as $removed_ability) {
			if ($removed_ability->users->count()==0 && $removed_ability->roles->count()==0) {
				$removed_ability->delete();
			}
		}
		
		// Update existed Ability
		foreach ($request->old_ability_id as $k => $old_ability_id) {
			$ability = Ability::find($old_ability_id);
			if ($ability) {
				$ability->update([
						'name' => $request->old_name[$k],
						'label' => $request->old_label[$k],
						'category' =>$request->old_category[$k],
						'ability_module_id' => $ability_module->id,
					]);
			}
		}
		
		// Create new Ability
		if ($request->category) {
			foreach ($request->category as $key => $category) {
				Ability::create([
					'name' => $request->name[$key],
					'label' => $request->label[$key],
					'category' => $category,
					'ability_module_id' => $ability_module->id,
				]);
			}
		}

		return back()->with('success', __('alert.message.success.crud.update'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(AbilityModule $ability_module)
	{
		if ($ability_module->delete()) {
			return back()->with('success', __('alert.message.success.crud.delete'));
		}
		return back()->with('error', __('alert.message.error.crud.delete'));
	}
}
