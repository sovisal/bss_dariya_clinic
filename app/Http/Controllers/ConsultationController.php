<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
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
	public function create(Patient $patient)
	{
		// $consultation = Consultation::where('patient_id', $patient->id)->where('status', 'pending')->first();
		$consultation = null;

		$data = [
			'patient' => $patient,
			'consultation' => $consultation
		];
		return view('consultation.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		dd($request);

		return redirect()->route('patient.index')->with('success', __('alert.message.success.crud.create'));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Patient $patient)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	// public function update(Request $request, Patient $patient)
	// {
	// 	return redirect()->route('patient.index')->with('success', __('alert.message.success.crud.create'));
	// }

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

}
