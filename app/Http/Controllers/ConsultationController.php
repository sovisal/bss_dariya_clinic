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
			'payment_types' => getParentDataSelection('payment_type'),
			'evaluation_categories' => getParentDataSelection('evalutaion_category'),
		];
		return view('consultation.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(ConsultationRequest $request)
	{
		if ($request->submit_option == 'cancel') {
			return redirect()->route('patient.index');
		} else {
			$json_data = serialize($request->all());
			Consultation::create([
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
		$data = [
			'consultation' => append_array_to_obj($consultation, unserialize($consultation->json_data) ?: []),
			'doctors' => Doctor::orderBy('name_kh', 'asc')->get(),
			'payment_types' => getParentDataSelection('payment_type'),
			'evaluation_categories' => getParentDataSelection('evalutaion_category'),
		];

		// For Indication tab
		$data['indication_diseases'] = $data['consultation']->evaluation_category ? 
			getParentDataSelection('indication_disease', ['status' => 1, 'parent_id' => $data['consultation']->evaluation_category]) :
			getParentDataSelection('indication_disease');

		// For Treatment plan tab
		$patient = Patient::find($consultation->patient_id);
		$data['list_prescription']	= $patient->prescriptions() ? $patient->prescriptions()->where('status', '>=', 1)->select('id', 'code')->get()->toArray() : [];
		$data['list_labor'] 		= $patient->labors() 		? $patient->labors()->where('status', '>=', 1)->select('id', 'code')->get()->toArray() : [];
		$data['list_xray'] 			= $patient->xrays() 		? $patient->xrays()->where('status', '>=', 1)->select('id', 'code')->get()->toArray() : [];
		$data['list_echo'] 			= $patient->echos() 		? $patient->echos()->where('status', '>=', 1)->select('id', 'code')->get()->toArray() : [];
		$data['list_ecg'] 			= $patient->ecgs() 			? $patient->ecgs()->where('status', '>=', 1)->select('id', 'code')->get()->toArray() : [];
		return view('consultation.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Consultation $consultation)
	{
		if ($request->submit_option == 'cancel') {
			return redirect()->route('patient.index');
		} else {
			$json_data = serialize($request->all());
			$consultation->update([
				'doctor_id' => $request->doctor_id,
				'payment_type' => $request->payment_type,
				'evaluated_at' => $request->evaluated_at,
				'json_data' => $json_data,
				'status' => $request->submit_option,
				'updated_by' => auth()->user()->id,
			]);
		}
		return redirect()->route('patient.index')->with('success', __('alert.message.success.crud.update'));
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
