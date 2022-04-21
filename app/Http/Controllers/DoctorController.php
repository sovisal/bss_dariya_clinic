<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Http\Requests\DoctorRequest;

class DoctorController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data = [
			'doctors' => Doctor::select([
										'doctors.*',
										'updatedBy.name AS updated_by_name',
									])
									->join('users AS updatedBy', 'updatedBy.id', '=' ,'doctors.updated_by')
									->orderBy('name_kh', 'asc')->get()
		];
		return view('doctor.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data = [
			
		];
		return view('doctor.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(DoctorRequest $request)
	{
		$doctor = Doctor::create([
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
		$url = route('setting.doctor.index');
		if ($request->save_opt == 'save_create') {
			$url = route('setting.doctor.create');
		}else if($request->save_opt == 'save_edit'){
			$url = route('setting.doctor.edit', $doctor->id);
		}
		return redirect($url)->with('success', __('alert.message.success.crud.create'));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Doctor $doctor)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Doctor $doctor)
	{
		$data = [
			'doctor' => $doctor
		];
		return view('doctor.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(DoctorRequest $request, Doctor $doctor)
	{
		$doctor->update([
			'name_kh' => $request->name_kh,
			'name_en' => $request->name_en,
			'id_card_no' => $request->id_card_no,
			'gender' => (($request->gender)? 1 : 0 ),
			'email' => $request->email,
			'phone' => $request->phone,
			'address' => $request->address,
			'updated_by' => auth()->user()->id,
		]);
		return back()->with('success', __('alert.message.success.crud.update'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Doctor $doctor)
	{
		if ($doctor->delete()) {
			return back()->with('success', __('alert.message.success.crud.delete'));
		}
		return back()->with('error', __('alert.message.error.crud.delete'));
	}

	// get Product Select2
	public function getSelect2()
	{
		return Doctor::getSelect2([], ['name_kh', 'asc'], ['id', 'name_kh']);
	}
}
