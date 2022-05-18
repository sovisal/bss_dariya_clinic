<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\EchoType;
use App\Models\Echography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\EchographyRequest;

class EchographyController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->data['rows'] = Echography::select([
			'echographies.*', 'patients.name_en as patient_en', 'doctors.name_en as doctor_en',
			'echo_types.name_en as type_en'
		])
		->where('echographies.status', '>=' , 1) //1-Draft, 2-Completed, Helper function render_record_status()
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
	public function store(EchographyRequest $request)
	{
		if ($request->status == 'Cancel') {
			return redirect()->route('para_clinic.echography.index');
		} else {
			// serialize all post into string
			$serialize = array_except($request->all(), ['_method', '_token']);
			$request['attribite'] = serialize($serialize);

			$echography = new Echography();
			if ($echo = $echography->create([
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
				return redirect()->route('para_clinic.echography.edit', $echo->id)->with('success', 'Data created success');
			}
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Echography  $echography
	 * @return \Illuminate\Http\Response
	 */
	public function getDetail(Request $request)
	{
		$echography = Echography::where('echographies.id', $request->id)
		->select([
			'echographies.*',
			'patients.name_en as patient_en',
			'doctors.name_en as doctor_en',
			'echo_types.name_en as type_en'
		])
		->leftJoin('patients', 'patients.id', '=', 'echographies.patient_id')
		->leftJoin('doctors', 'doctors.id', '=', 'echographies.doctor_id')
		->leftJoin('echo_types', 'echo_types.id', '=', 'echographies.type')
		->first();
		if ($echography) {
			$status_html = (($echography->status)? '<span class="badge badge-primary">Completed</span>' : '<span class="badge badge-light">Progress</span>');
			$status_html .= (($echography->payment_status)? '<span class="badge badge-success tw-ml-1">Paid</span>' : '<span class="badge badge-light tw-ml-1">Unpaid</span>');
			$tbody = '';
			$except_fields = [
				'code',
				'patient_id',
				'doctor_id',
				'type',
				'payment_type',
				'payment_status',
				'requested_by',
				'requested_at',
				'image_1',
				'image_2',
				'amount',
				'status',
				'other',
				'crl_unit',
				'gs_unit',
				'pregnancy_age1_unit',
				'pregnancy_age2_unit',
				'before_after_unit',
				'heart_rate_unit',
				'head_to_butt_length_unit',
				'head_width_unit',
				'thigh_length_unit',
				'pregnancy_age1_unit',
				'pregnancy_age2_unit',
				'before_after_unit',
				'heart_rate_unit',
				'head_width_unit',
				'head_circumference_unit',
				'abdominal_circumference_unit',
				'thigh_length_unit',
				'pregnancy_age1_unit',
				'pregnancy_age2_unit',
				'baby_weight_unit',
				'over_under_unit',
				'before_after_unit',
				'heart_rate_unit',
				'head_width_unit',
				'head_circumference_unit',
				'abdominal_circumference_unit',
				'thigh_length_unit',
				'pregnancy_age1_unit',
				'pregnancy_age2_unit',
				'baby_weight_unit',
				'over_under_unit',
				'before_after_unit',
			];
			$all_attributes = unserialize($echography->attribute) ?: [];
			$attributes = array_except($all_attributes, $except_fields);
			foreach ($attributes as $label => $attr) {
				$unit = (( $attr!='' && array_key_exists($label . '_unit', $all_attributes))? '<span class="tw-ml-1">'. $all_attributes[$label . '_unit'] .'</span>' : '');
				$tbody .= '<tr>
								<td width="30%" class="text-right tw-bg-gray-100">'. __('form.echography.'. $label) .'</td>
								<td>'. $attr . $unit .'</td>
							</tr>';
			}
			return response()->json([
				'success' => true,
				'echography' => $echography,
				'status_html' => $status_html,
				'tbody' => ((empty($attributes))? '<tr><th colspan="4" class="text-center">No result</th></tr>' : $tbody),
			]);
		}else{
			return response()->json([
				'success' => false,
				'message' => 'Echography not found!',
			], 404);
		}
	}

	/**
	 * Display the specified Image.
	 */
	public function print($id)
	{
		$echography = Echography::select([
			'echographies.*',
			'patients.name_kh as patient_kh',
			'patients.age as patient_age',
			'data_parents.title_en as patient_gender',
			'doctors.name_kh as doctor_kh',
			'echo_types.name_kh as type_kh'
		])
		->leftJoin('patients', 'patients.id', '=', 'echographies.patient_id')
		->leftJoin('data_parents', 'data_parents.id', '=', 'patients.gender')
		->leftJoin('doctors', 'doctors.id', '=', 'echographies.doctor_id')
		->leftJoin('echo_types', 'echo_types.id', '=', 'echographies.type')
		->find($id);
		$data['echography'] = $echography;
		return view('echography.print', $data);
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
	 */
	public function update(EchographyRequest $request, Echography $echography)
	{
		if ($request->status == 'Cancel') {
			return redirect()->route('para_clinic.echography.index');
		} else {
			// serialize all post into string
			$serialize = array_except($request->all(), ['_method', '_token', 'img_1', 'img_2']);
			$request['attribute'] = serialize($serialize);
			$request['amount'] = $request->amount ?? 0;
			
			$path = public_path('/images/echographies/');
			File::makeDirectory($path, 0777, true, true);
			if ($request->file('img_1')) {
				$img_1 = $request->file('img_1');
				$img_1_name = (($echography->image_1!='')? $echography->image_1 : time() .'_'. $echography->id .'.png');
				Image::make($img_1->getRealPath())->save($path . $img_1_name);
				$request['image_1'] = $img_1_name;
			}
			if ($request->file('img_2')) {
				$img_2 = $request->file('img_2');
				$img_2_name = (($echography->image_2!='')? $echography->image_2 : time() .'_'. $echography->id .'.png');
				Image::make($img_2->getRealPath())->save($path . $img_2_name);
				$request['image_2'] = $img_2_name;
			}

			if ($echography->update($request->all())) {
				return redirect()->route('para_clinic.echography.index')->with('success', 'Data update success');
			}
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
