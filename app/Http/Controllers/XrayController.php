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
	 *
	 * @return \Illuminate\Http\Response
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
	 *
	 * @return \Illuminate\Http\Response
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
		if ($record = $xray->create([
			// 'code' => $request->code,
			'type' => $request->type,
			'patient_id' => $request->patient_id,
			'doctor_id' => $request->doctor_id,
			'requested_by' => $request->requested_by,
			'payment_type' => $request->payment_type,
			'payment_status' => 0,
			'requested_at' => $request->requested_at,
			'amount' => $request->amount ?: 0,
			'attribute' => $request->type > 0 ? XrayType::find($request->type)->first()->attribite : null,
			'status' => 1,
		])) {
			return redirect()->route('para_clinic.xray.edit', $record->id)->with('success', 'Data created success');
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function getDetail(Request $request)
	{
		$xray = Xray::where('xrays.id', $request->id)
		->select([
			'xrays.*',
			'patients.name_en as patient_kh',
			'doctors.name_en as doctor_en',
			'xray_types.name_en as type_en'
		])
		->leftJoin('patients', 'patients.id', '=', 'xrays.patient_id')
		->leftJoin('data_parents', 'data_parents.id', '=', 'patients.gender')
		->leftJoin('doctors', 'doctors.id', '=', 'xrays.doctor_id')
		->leftJoin('xray_types', 'xray_types.id', '=', 'xrays.type')
		->first();

		if ($xray) {
			$status_html = (($xray->status==2)? '<span class="badge badge-primary">Completed</span>' : '<span class="badge badge-light">Progress</span>');
			$status_html .= (($xray->payment_status==2)? '<span class="badge badge-success tw-ml-1">Paid</span>' : '<span class="badge badge-light tw-ml-1">Unpaid</span>');
			$tbody = '';
			$attributes = array_except(filter_unit_attr(unserialize($xray->attribute) ?: []), ['status', 'amount']);
			foreach ($attributes as $label => $attr) {
				$tbody .= '<tr>
								<td width="30%" class="text-right tw-bg-gray-100">'. __('form.xray.'. $label) .'</td>
								<td>'. $attr .'</td>
							</tr>';
			}
			return response()->json([
				'success' => true,
				'xray' => $xray,
				'status_html' => $status_html,
				'print_url' => route('para_clinic.xray.print', $xray->id),
				'tbody' => ((empty($attributes))? '<tr><th colspan="4" class="text-center">No result</th></tr>' : $tbody),
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
}
