<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Http\Requests\ConsultationRequest;

class ConsultationController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data = [
			'consultations' => [0,1,2,3,4,5,6,7,8,9]
		];
		return view('consultation.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$patient = Patient::find(request()->patient) ?? null;
		if ($patient) {
			session(['consultation_cancel_route' => 'patient.index']);
		}else{
			session(['consultation_cancel_route' => 'patient.consultation.index']);
		}
		$data = [
			'patient' => $patient,
			'doctors' => Doctor::orderBy('name_kh', 'asc')->get(),
			'payment_types' => getParentDataSelection('payment_type')
		];
		return view('consultation.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(ConsultationRequest $request)
	{
		if ($request->submit_option == 'cancel') {
			return redirect()->route(session('consultation_cancel_route'));
		} else {
			$json_data = serialize($request->all());
			$consultation = Consultation::create([
				'patient_id' => $request->patient_id,
				'doctor_id' => $request->doctor_id,
				'payment_type' => $request->payment_type,
				'evaluated_at' => $request->evaluated_at,
				'json_data' => $json_data,
				'status' => $request->submit_option,
				'created_by' => auth()->user()->id,
				'updated_by' => auth()->user()->id,
			]);
		}
		return redirect()->route('patient.show', $request->patient_id)->with('success', __('alert.message.success.crud.create'));
	}

	/**
	 * Display the specified resource.
	 */
	public function edit(Consultation $consultation)
	{
		$patient = Patient::find(request()->patient) ?? null;
		if ($patient) {
			session(['consultation_cancel_route' => 'patient.index']);
		}else{
			session(['consultation_cancel_route' => 'patient.consultation.index']);
		}
		$data = [
			'consultation' => $consultation,
			'json_data' => unserialize($consultation->json_data),
			'patient' => $patient,
			'doctors' => Doctor::orderBy('name_kh', 'asc')->get(),
			'payment_types' => getParentDataSelection('payment_type')
		];
		return view('consultation.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Consultation $consultation)
	{
		dd($request->all());
		
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Consultation $consultation)
	{
		if ($consultation->delete()) {
			return back()->with('success', __('alert.message.success.crud.delete'));
		}
		return back()->with('error', __('alert.message.error.crud.delete'));
	}

}
