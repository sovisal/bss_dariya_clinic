<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PatientRequest;
use Intervention\Image\Facades\Image;

class PatientController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data = [
			'patients' => Patient::select([
										'patients.*',
										'updatedBy.name AS updated_by_name',
									])
									->join('users AS updatedBy', 'updatedBy.id', '=' ,'patients.updated_by')
									->orderBy('name_kh', 'asc')->get()
		];
		return view('patient.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data = [
			
		];
		return view('patient.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(PatientRequest $request)
	{
		$patient = Patient::create([
			'name_kh' => $request->name_kh,
			'name_en' => $request->name_en,
			'id_card_no' => $request->id_card_no,
			'gender' => $request->gender,
			'email' => $request->email,
			'phone' => $request->phone,
			'date_of_birth' => $request->date_of_birth,
			'age' => $request->age,
			'nationality' => $request->nationality,
			'marital_status' => $request->marital_status,
			'education' => $request->education,
			'position' => $request->position,
			'enterprise' => $request->enterprise,
			'father_name' => $request->father_name,
			'father_position' => $request->father_position,
			'mother_name' => $request->mother_name,
			'mother_position' => $request->mother_position,
			'blood_type' => $request->blood_type,
			'house_no' => $request->house_no,
			'street_no' => $request->street_no,
			'zip_code' => $request->zip_code,
			'registered_at' => $request->registered_at,
			'created_by' => auth()->user()->id,
			'updated_by' => auth()->user()->id,
		]);

		if ($request->file('photo')) {
			$path = public_path().'/images/echoes/';
			File::makeDirectory($path, 0777, true, true);
			$photo = $request->file('photo');
			$photo_name = time() .'_'. $patient->id .'.png';
			Image::make($photo->getRealPath())->save($path.$photo_name);
			$patient->update(['photo' => $photo_name]);
		}

		return redirect()->route('patient.edit', $patient->id)->with('success', __('alert.message.success.crud.create'));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Patient $patient)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Patient $patient)
	{
		$data = [
			'patient' => $patient
		];
		return view('patient.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(PatientRequest $request, Patient $patient)
	{
		$patient->update([
			'name_kh' => $request->name_kh,
			'name_en' => $request->name_en,
			'id_card_no' => $request->id_card_no,
			'gender' => $request->gender,
			'email' => $request->email,
			'phone' => $request->phone,
			'date_of_birth' => $request->date_of_birth,
			'age' => $request->age,
			'nationality' => $request->nationality,
			'marital_status' => $request->marital_status,
			'education' => $request->education,
			'position' => $request->position,
			'enterprise' => $request->enterprise,
			'father_name' => $request->father_name,
			'father_position' => $request->father_position,
			'mother_name' => $request->mother_name,
			'mother_position' => $request->mother_position,
			'blood_type' => $request->blood_type,
			'house_no' => $request->house_no,
			'street_no' => $request->street_no,
			'zip_code' => $request->zip_code,
			'registered_at' => $request->registered_at,
			'updated_by' => auth()->user()->id,
		]);

		if ($request->file('photo')) {
			$path = public_path().'/images/patients/';
			File::makeDirectory($path, 0777, true, true);
			$photo = $request->file('photo');
			$patient_photo = (($patient->photo!='')? $patient->photo : time() .'_'. $patient->id .'.png');
			Image::make($photo->getRealPath())->save($path.$patient_photo);
			$patient->update(['photo'=>$patient_photo]);
		}

		return redirect()->route('patient.edit', $patient->id)->with('success', __('alert.message.success.crud.update'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Patient $patient)
	{
		if ($patient->delete()) {
			return back()->with('success', __('alert.message.success.crud.delete'));
		}
		return back()->with('error', __('alert.message.error.crud.delete'));
	}

	/**
	 * Display a listing of the resource.
	 */
	public function consulting()
	{
		$data = [
			
		];
		return view('patient.consulting', $data);
	}
}
