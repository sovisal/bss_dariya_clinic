<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\DataParent;
use Illuminate\Http\Request;
use App\Http\Requests\MedicineRequest;

class MedicineController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data = [
			'medicines' => Medicine::select([
										'medicines.*',
										'updatedBy.name AS updated_by_name',
										'Usage.title_kh AS usage_name_kh',
										'Usage.title_en AS usage_name_en',
									])
									->join('users AS updatedBy', 'updatedBy.id', '=' ,'medicines.updated_by')
									->join('data_parents AS Usage', 'Usage.id', '=' ,'medicines.usage_id')
									->orderBy('name', 'asc')->get(),
		];
		return view('medicine.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data = [
			'usages' => DataParent::usage()->orderBy('title_en', 'asc')->get()
		];
		return view('medicine.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(MedicineRequest $request)
	{
		$medicine = Medicine::create([
			'name' => $request->name,
			'price' => $request->price,
			'usage_id' => $request->usage_id,
			'description' => $request->description,
			'created_by' => auth()->user()->id,
			'updated_by' => auth()->user()->id,
		]);
		$url = route('setting.medicine.index');
		if ($request->save_opt == 'save_create') {
			$url = route('setting.medicine.create');
		}else if($request->save_opt == 'save_edit'){
			$url = route('setting.medicine.edit', $medicine->id);
		}
		return redirect($url)->with('success', __('alert.message.success.crud.create'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Medicine $medicine)
	{
		$data = [
			'medicine' => $medicine,
			'usages' => DataParent::usage()->orderBy('title_en', 'asc')->get()
		];
		return view('medicine.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(MedicineRequest $request, Medicine $medicine)
	{
		$medicine->update([
			'name' => $request->name,
			'price' => $request->price,
			'usage_id' => $request->usage_id,
			'description' => $request->description,
			'updated_by' => auth()->user()->id,
		]);
		return back()->with('success', __('alert.message.success.crud.update'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Medicine $medicine)
	{
		if ($medicine->delete()) {
			return back()->with('success', __('alert.message.success.crud.delete'));
		}
		return back()->with('error', __('alert.message.error.crud.delete'));
	}

	// get Product Select2
	public function getSelect2()
	{
		return Medicine::getSelect2([], ['name', 'asc'], ['id', 'name']);
	}
}
