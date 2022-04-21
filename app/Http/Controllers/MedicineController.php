<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
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
									])
									->join('users AS updatedBy', 'updatedBy.id', '=' ,'medicines.updated_by')
									->orderBy('name_kh', 'asc')->get()
		];
		$this->data = [];
		return view('medicine.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data = [
			
		];
		return view('medicine.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(MedicineRequest $request)
	{
		$medicine = Medicine::create([
			'name_kh' => $request->name_kh,
			'name_en' => $request->name_en,
			'id_card_no' => $request->id_card_no,
			'gender' => (($request->gender)? 1 : 0 ),
			'email' => $request->email,
			'phone' => $request->phone,
			'address' => $request->address,
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
	 * Display the specified resource.
	 */
	public function show(Medicine $medicine)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Medicine $medicine)
	{
		$data = [
			'medicine' => $medicine
		];
		return view('medicine.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(MedicineRequest $request, Medicine $medicine)
	{
		// dd($request->gender);
		$medicine->update([
			'name_kh' => $request->name_kh,
			'name_en' => $request->name_en,
			'id_card_no' => $request->id_card_no,
			'gender' => (($request->gender)? 1 : 0 ),
			'email' => $request->email,
			'phone' => $request->phone,
			'address' => $request->address,
			'created_by' => auth()->user()->id,
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
		return Medicine::getSelect2([], ['name_kh', 'asc'], ['id', 'name_kh']);
	}
}