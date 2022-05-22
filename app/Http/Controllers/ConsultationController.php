<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\EchoType;
use App\Models\XrayType;
use App\Models\Consultation;
use App\Models\EcgType;
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
			$attribute = serialize($request->all());
			Consultation::create([
				'patient_id' => $request->patient_id,
				'doctor_id' => $request->doctor_id,
				'payment_type' => $request->payment_type,
				'evaluated_at' => $request->evaluated_at,
				'attribute' => $attribute,
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
			'consultation' => append_array_to_obj($consultation, unserialize($consultation->attribute) ?: []),
			'doctors' => Doctor::orderBy('name_en', 'asc')->get(),
			'payment_types' => getParentDataSelection('payment_type'),
			'evaluation_categories' => getParentDataSelection('evalutaion_category'),
		];

		// For Indication tab
		$data['indication_diseases'] = $data['consultation']->evaluation_category ? 
			getParentDataSelection('indication_disease', ['status' => 1, 'parent_id' => $data['consultation']->evaluation_category]) :
			getParentDataSelection('indication_disease');

		// For Treament plan tab
		$data['ecg_type'] = EcgType::where('status', 1)->orderBy('index', 'asc')->get();
		$data['xray_type'] = XrayType::where('status', 1)->orderBy('index', 'asc')->get();
		$data['echo_type'] = EchoType::where('status', 1)->orderBy('index', 'asc')->get();
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
			$attribute = serialize($request->all());
			$consultation->update([
				'doctor_id' => $request->doctor_id,
				'payment_type' => $request->payment_type,
				'evaluated_at' => $request->evaluated_at,
				'attribute' => $attribute,
				'status' => $request->submit_option,
				'updated_by' => auth()->user()->id,
			]);
		}
		return redirect()->route('patient.index')->with('success', __('alert.message.success.crud.update'));
	}

	public function getTemplate(Request $request)
	{
		$analysed_by = '<option value="">Please choose</option>';
		$doctors = Doctor::orderBy('name_en', 'asc')->get();
		foreach ($doctors as $doctor) {
			$analysed_by .= '<option value="'. $doctor->id .'">'. $doctor->name_en .'</option>';
		}

		$template = '<option value="">Please choose</option>';
		if ($request->type == 'echography') {
			$types = EchoType::where('status', 1)->orderBy('index', 'asc')->get();
			foreach ($types as $type) {
				$template .= '<option value="'. $type->id .'">'. $type->name_en .'</option>';
			}
		}

		return response()->json([
			'analysed_by' => $analysed_by,
			'template' => $template,
		]);
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

	public function getTreamentPlanLinkLabel($patient_id = 2)
	{
		// For Treatment plan tab
		$patient = Patient::find($patient_id);
		$data['list_prescription']	= $patient->prescriptions() ? $patient->prescriptions()->where('status', '>=', 1)->select('id', 'code')->get()->toArray() : [];
		$data['list_labor'] 		= $patient->labors() 		? $patient->labors()->where('status', '>=', 1)->select('id', 'code')->get()->toArray() : [];
		$data['list_xray'] 			= $patient->xrays() 		? $patient->xrays()->where('status', '>=', 1)->select('id', 'code')->get()->toArray() : [];
		$data['list_echo'] 			= $patient->echos() 		? $patient->echos()->where('status', '>=', 1)->select('id', 'code')->get()->toArray() : [];
		$data['list_ecg'] 			= $patient->ecgs() 			? $patient->ecgs()->where('status', '>=', 1)->select('id', 'code')->get()->toArray() : [];

		$label = array_map(function ($val) {
			return '<a href="' . route('prescription.show', $val['id']) . '">' . ($val['code'] ?: 'N/A') . '</a>';
		}, $data['list_prescription']);
		$data['list_prescription'] = implode($label, ',  ');

		$label = array_map(function ($val) {
			return '<a href="' . route('para_clinic.labor.show', $val['id']) . '">' . ($val['code'] ?: 'N/A') . '</a>';
		}, $data['list_labor']);
		$data['list_labor'] = implode($label, ',  ');

		$label = array_map(function ($val) {
			return '<a href="' . route('para_clinic.xray.show', $val['id']) . '">' . ($val['code'] ?: 'N/A') . '</a>';
		}, $data['list_xray']);
        $data['list_xray'] = implode($label, ',  ');

		$label = array_map(function ($val) {
			return '<a href="' . route('para_clinic.echography.show', $val['id']) . '">' . ($val['code'] ?: 'N/A') . '</a>';
		}, $data['list_echo']);
		$data['list_echo'] = implode($label, ',  ');

		$label = array_map(function ($val) {
			return '<a href="' . route('para_clinic.ecg.show', $val['id']) . '">' . ($val['code'] ?: 'N/A') . '</a>';
		}, $data['list_ecg']);
        $data['list_ecg'] = implode($label, ',  ');

		return json_encode($data);
	}

}
