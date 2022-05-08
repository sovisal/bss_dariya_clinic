<?php

namespace App\Http\Controllers;

use App\Models\EchoType;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Echography;
use App\Http\Requests\StoreEchographyRequest;
use App\Http\Requests\UpdateEchographyRequest;
use Illuminate\Http\Request;

class EchographyController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->data['rows'] = Echography::where('echographies.status', 1)
		->select([
			'echographies.*', 'patients.name_en as patient_en', 'doctors.name_en as doctor_en',
			'echo_types.name_en as type_en'
		])
		->leftJoin('patients', 'patients.id', '=', 'echographies.patient_id')
		->leftJoin('doctors', 'doctors.id', '=', 'echographies.doctor_id')
		->leftJoin('echo_types', 'echo_types.id', '=', 'echographies.type')
		->orderBy('echographies.id', 'desc')
		->get();
		return view('echography.index', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['type'] = EchoType::where('status', 1)->orderBy('index', 'asc')->get();
		$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
		$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		$data['payment_type'] = getParentDataSelection('payment_type');
		$data['is_edit'] = false;
		return view('echography.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreEchographyRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// serialize all post into string
		$serialize = array_except($request->all(), ['_method', '_token']);
		$request['attribite'] = serialize($serialize);

		$dataParent = new Echography();
		if ($dataParent->create([
			// 'code' => $request->code,
			'type' => $request->type,
			'patient_id' => $request->patient_id,
			'doctor_id' => $request->doctor_id,
			'requested_by' => $request->requested_by,
			'payment_type' => $request->payment_type,
			'payment_status' => 0,
			'requested_at' => $request->requested_at,
			'amount' => $request->amount ?: 0,
			'attribite' => $request->attribite,
			'status' => 1,
		])) {
			return redirect()->route('para_clinic.echography.index')->with('success', 'Data created success');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Echography  $echography
	 * @return \Illuminate\Http\Response
	 */
	public function show(Echography $echography)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Echography  $echography
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Echography $echography)
	{
		append_array_to_obj($echography, unserialize($echography->attribute) ?: []);
		if ($echography ?? false) {
			$data['row'] = $echography;
			$data['type'] = EchoType::where('status', 1)->orderBy('index', 'asc')->get();
			$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
			$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		} 
		$data['payment_type'] = getParentDataSelection('payment_type');
		$data['is_edit'] = true;
		return view('echography.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateEchographyRequest  $request
	 * @param  \App\Models\Echography  $echography
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Echography $echography)
	{
		$request['status'] = 1;

		// serialize all post into string
		$serialize = array_except($request->all(), ['_method', '_token']);
		$request['attribute'] = serialize($serialize);

		if ($echography->update($request->all())) {
			return redirect()->route('para_clinic.echography.index')->with('success', 'Data update success');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Echography  $echography
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Echography $echography)
	{
		$echography->status = 0;
		if ($echography->update()) {
			return redirect()->route('para_clinic.echography.index')->with('success', 'Data delete success');
		}
	}
}
