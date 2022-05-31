<?php

namespace App\Http\Controllers;

use App\Models\Ecg;
use App\Models\Doctor;
use App\Models\EcgType;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreEcgRequest;
use App\Http\Requests\UpdateEcgRequest;

class EcgController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->data['rows'] = Ecg::where('ecgs.status', '>=' , 1)
		->select([
			'ecgs.*', 
			'patients.name_en as patient_en', 
			'patients.name_kh as patient_kh', 
			'doctors.name_en as doctor_en',
			'doctors.name_kh as doctor_kh',
			'ecg_types.name_en as type_en',
			'ecg_types.name_kh as type_kh'
		])
		->leftJoin('patients', 'patients.id', '=', 'ecgs.patient_id')
		->leftJoin('doctors', 'doctors.id', '=', 'ecgs.doctor_id')
		->leftJoin('ecg_types', 'ecg_types.id', '=', 'ecgs.type')
		->orderBy('ecgs.id', 'desc')
		->get();
		return view('ecg.index', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['type'] = EcgType::where('status', 1)->orderBy('index', 'asc')->get();
		$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
		$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		$data['payment_type'] = getParentDataSelection('payment_type');
		$data['is_edit'] = false;
		return view('ecg.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreEcgRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$ecg = new Ecg();
		if ($request->type) {
			$ecg_type = EcgType::where('id', $request->type)->first();
		}
		if ($record = $ecg->create([
			'code' => generate_code('ECG', 'ecgs'),
			'type' => $request->type,
			'patient_id' => $request->patient_id,
			'doctor_id' => $request->doctor_id,
			'requested_by' => $request->requested_by ?: auth()->user()->doctor ?? 0,
			'payment_type' => $request->payment_type ?? 0,
			'payment_status' => 0,
			'requested_at' => $request->requested_at ?: date('Y-m-d H:i:s'),
			'amount' => $request->amount ?: ($ecg_type ? $ecg_type->price : 0),
			'attribute' => $ecg_type ? $ecg_type->attribite : null,
			'status' => 1,
		])) {
			if ($request->is_treament_plan) {
				return redirect()->route('patient.consultation.edit', $request->consultation_id)->with('success', 'Data created success');
			} else {
				return redirect()->route('para_clinic.ecg.edit', $record->id)->with('success', 'Data created success');
			}
		}
	}
	
	/**
	 * Display the specified resource.
	 */
	public function getDetail(Request $request)
	{
		$row = Ecg::where('ecgs.id', $request->id)
		->select([
			'ecgs.*',
			'patients.name_kh as patient_kh',
			'physicians.name_en as physician',
			'requestedBy.name_en as requested_by_name',
			'paymentTypes.title_en as payment_type_en',
			'ecg_types.name_en as type_en'
		])
		->leftJoin('patients', 'patients.id', '=', 'ecgs.patient_id')
		->leftJoin('data_parents AS paymentTypes', 'paymentTypes.id', '=', 'ecgs.payment_type')
		->leftJoin('doctors AS physicians', 'physicians.id', '=', 'ecgs.doctor_id')
		->leftJoin('doctors AS requestedBy', 'requestedBy.id', '=', 'ecgs.requested_by')
		->leftJoin('ecg_types', 'ecg_types.id', '=', 'ecgs.type')
		->first();

		if ($row) {
			$body = '';
			$tbody = '';
			$attributes = array_except(filter_unit_attr(unserialize($row->attribute) ?: []), ['status', 'amount']);
			foreach ($attributes as $label => $attr) {
				$tbody .= '<tr>
								<td width="30%" class="text-right tw-bg-gray-100">'. __('form.ecg.'. $label) .'</td>
								<td>'. $attr .'</td>
							</tr>';
			}
			$body = '<table class="table-form tw-mt-3 table-detail-result">
						<thead>
							<tr>
								<th colspan="4" class="text-left tw-bg-gray-100">Result</th>
							</tr>
						</thead>
						<tbody>'. ((empty($attributes))? '<tr><th colspan="4" class="text-center">No result</th></tr>' : $tbody) .'</tbody>
					</table>';
			return response()->json([
				'success' => true,
				'header' => getParaClinicHeaderDetail($row),
				'body' => $body,
				'print_url' => route('para_clinic.ecg.print', $row->id),
			]);
		}else{
			return response()->json([
				'success' => false,
				'message' => 'ECG not found!',
			], 404);
		}
	}

	/**
	 * Print the specified resource.
	 */
	public function print($id)
	{
		$ecg = Ecg::select([
			'ecgs.*',
			'patients.name_en as patient_kh',
			'patients.age as patient_age',
			'data_parents.title_en as patient_gender',
			'doctors.name_en as doctor_en',
			'ecg_types.name_en as type_en'
		])
		->leftJoin('patients', 'patients.id', '=', 'ecgs.patient_id')
		->leftJoin('data_parents', 'data_parents.id', '=', 'patients.gender')
		->leftJoin('doctors', 'doctors.id', '=', 'ecgs.doctor_id')
		->leftJoin('ecg_types', 'ecg_types.id', '=', 'ecgs.type')
		->find($id);
		$ecg->attribute = array_except(filter_unit_attr(unserialize($ecg->attribute) ?: []), ['status', 'amount', 'payment_type', 'requested_by']);
		$data['ecg'] = $ecg;
		return view('ecg.print', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Ecg $ecg)
	{
		append_array_to_obj($ecg, unserialize($ecg->attribute) ?: []);
		if ($ecg ?? false) {
			$data['row'] = $ecg;
			$data['type'] = EcgType::where('status', 1)->orderBy('index', 'asc')->get();
			$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
			$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		}
		$data['payment_type'] = getParentDataSelection('payment_type');
		$data['is_edit'] = true;
		return view('ecg.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Ecg $ecg)
	{
		// serialize all post into string
		$serialize = array_except($request->all(), ['_method', '_token']);
		$request['attribute'] = serialize($serialize);
		$request['amount'] = $request->amount ?? 0;

		if ($ecg->update($request->all())) {
			return redirect()->route('para_clinic.ecg.index')->with('success', 'Data update success');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Ecg $ecg)
	{
		$ecg->status = 0;
		if ($ecg->update()) {
			return redirect()->route('para_clinic.ecg.index')->with('success', 'Data delete success');
		}
	}

	public function show(Ecg $ecg)
	{
		append_array_to_obj($ecg, unserialize($ecg->attribute) ?: []);
		if ($ecg ?? false) {
			$data['row'] = $ecg;
			$data['type'] = EcgType::where('status', 1)->orderBy('index', 'asc')->get();
			$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
			$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		}
		$data['payment_type'] = getParentDataSelection('payment_type');
		$data['is_edit'] = true;
		return view('ecg.show', $data);
	}
}
