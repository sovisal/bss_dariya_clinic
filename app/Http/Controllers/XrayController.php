<?php

namespace App\Http\Controllers;

use App\Models\Xray;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\XrayType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreXrayRequest;
use App\Http\Requests\UpdateXrayRequest;

class XrayController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->data['rows'] = Xray::where('xrays.status', '>=' , 1)
		->select([
			'xrays.*', 'patients.name_en as patient_en', 'doctors.name_en as doctor_en',
			'xray_types.name_en as type_en'
		])
		->leftJoin('patients', 'patients.id', '=', 'xrays.patient_id')
		->leftJoin('doctors', 'doctors.id', '=', 'xrays.doctor_id')
		->leftJoin('xray_types', 'xray_types.id', '=', 'xrays.type')
		->orderBy('xrays.id', 'desc')
		->get();
		return view('xray.index', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['type'] = XrayType::where('status', 1)->orderBy('index', 'asc')->get();
		$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
		$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		$data['payment_type'] = getParentDataSelection('payment_type');
		$data['is_edit'] = false;
		return view('xray.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$xray = new Xray();
		if ($request->type) {
			$xray_type = XrayType::where('id', $request->type)->first();
		}
		if ($record = $xray->create([
			'code' => generate_code('XRA', 'xrays'),
			'type' => $request->type,
			'patient_id' => $request->patient_id,
			'doctor_id' => $request->doctor_id,
			'requested_by' => $request->requested_by ?: auth()->user()->doctor ?? 0,
			'payment_type' => $request->payment_type ?? 0,
			'payment_status' => 0,
			'requested_at' => $request->requested_at ?: date('Y-m-d H:i:s'),
			'amount' => $request->amount ?: ($xray_type ? $xray_type->price : 0),
			'attribute' => $xray_type ? $xray_type->attribite : null,
			'status' => 1,
		])) {
			if ($request->is_treament_plan) {
				return redirect()->route('patient.consultation.edit', $request->consultation_id)->with('success', 'Data created success');
			} else {
				return redirect()->route('para_clinic.xray.edit', $record->id)->with('success', 'Data created success');
			}
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function getDetail(Request $request)
	{
		$row = Xray::where('xrays.id', $request->id)
		->select([
			'xrays.*',
			'patients.name_kh as patient_kh',
			'physicians.name_en as physician',
			'requestedBy.name_en as requested_by_name',
			'paymentTypes.title_en as payment_type_en',
			'xray_types.name_en as type_en'
		])
		->leftJoin('patients', 'patients.id', '=', 'xrays.patient_id')
		->leftJoin('data_parents AS paymentTypes', 'paymentTypes.id', '=', 'xrays.payment_type')
		->leftJoin('doctors AS physicians', 'physicians.id', '=', 'xrays.doctor_id')
		->leftJoin('doctors AS requestedBy', 'requestedBy.id', '=', 'xrays.requested_by')
		->leftJoin('xray_types', 'xray_types.id', '=', 'xrays.type')
		->first();

		if ($row) {
			$body = '';
			$tbody = '';
			$attributes = array_except(filter_unit_attr(unserialize($row->attribute) ?: []), ['status', 'amount']);
			foreach ($attributes as $label => $attr) {
				$tbody .= '<tr>
								<td width="30%" class="text-right tw-bg-gray-100">'. __('form.xray.'. $label) .'</td>
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
				'print_url' => route('para_clinic.xray.print', $row->id),
			]);
		}else{
			return response()->json([
				'success' => false,
				'message' => 'X-Ray not found!',
			], 404);
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function print($id)
	{
		$xray = Xray::select([
			'xrays.*',
			'patients.name_en as patient_kh',
			'patients.age as patient_age',
			'data_parents.title_en as patient_gender',
			'doctors.name_en as doctor_en',
			'xray_types.name_en as type_en'
		])
		->leftJoin('patients', 'patients.id', '=', 'xrays.patient_id')
		->leftJoin('data_parents', 'data_parents.id', '=', 'patients.gender')
		->leftJoin('doctors', 'doctors.id', '=', 'xrays.doctor_id')
		->leftJoin('xray_types', 'xray_types.id', '=', 'xrays.type')
		->find($id);
		$xray->attribute = array_except(filter_unit_attr(unserialize($xray->attribute) ?: []), ['status', 'amount']);
		$data['xray'] = $xray;
		return view('xray.print', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Xray $xray)
	{
		append_array_to_obj($xray, unserialize($xray->attribute) ?: []);
		if ($xray ?? false) {
			$data['row'] = $xray;
			$data['type'] = XrayType::where('status', 1)->orderBy('index', 'asc')->get();
			$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
			$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		} 
		$data['payment_type'] = getParentDataSelection('payment_type');
		$data['is_edit'] = true;
		return view('xray.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Xray $xray)
	{
		// serialize all post into string
		$serialize = array_except($request->all(), ['_method', '_token']);
		$request['attribute'] = serialize($serialize);
		$request['amount'] = $request->amount ?? 0;

		if ($xray->update($request->all())) {
			return redirect()->route('para_clinic.xray.index')->with('success', 'Data update success');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Xray $xray)
	{
		$xray->status = 0;
		if ($xray->update()) {
			return redirect()->route('para_clinic.xray.index')->with('success', 'Data delete success');
		}
	}

	public function show(Xray $xray)
	{
		append_array_to_obj($xray, unserialize($xray->attribute) ?: []);
		if ($xray ?? false) {
			$data['row'] = $xray;
			$data['type'] = XrayType::where('status', 1)->orderBy('index', 'asc')->get();
			$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
			$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		} 
		$data['payment_type'] = getParentDataSelection('payment_type');
		$data['is_edit'] = true;
		return view('xray.show', $data);
	}
}
