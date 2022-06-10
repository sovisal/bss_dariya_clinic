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
			'echographies.*', 
			'patients.name_en as patient_en', 
			'patients.name_kh as patient_kh', 
			'doctors.name_en as doctor_en',
			'doctors.name_kh as doctor_kh',
			'echo_types.name_en as type_en',
			'echo_types.name_kh as type_kh'
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
	 */
	public function store(EchographyRequest $request)
	{
		$echography = new Echography();
		if ($request->type) {
            $echo_type = EchoType::where('id', $request->type)->first();
        }

		if ($request->file('img_1')) {
			$img_1_name = time() .'_image_1_'. rand(111,999) .'.png';
			$request['image_1'] = $img_1_name;
		}
		if ($request->file('img_2')) {
			$img_2_name = time() .'_image_2_'. rand(111,999) .'.png';
			$request['image_2'] = $img_2_name;
		}

		if ($echo = $echography->create([
			'code' => generate_code('ECH', 'echographies'),
			'type' => $request->type,
			'patient_id' => $request->patient_id,
			'doctor_id' => $request->doctor_id ?: 0,
			'requested_by' => $request->requested_by ?: auth()->user()->doctor ?? 0,
			'payment_type' => $request->payment_type ?? 0,
			'payment_status' => 0,
			'requested_at' => $request->requested_at,
			'image_1' => $request->image_1,
			'image_2' => $request->image_2,
            'amount' => $request->amount ?: ($echo_type ? $echo_type->price : 0),
            'attribute' => $echo_type ? $echo_type->attribite : null,
			'status' => 1,
		])) {

			$path = public_path('/images/echographies/');
			File::makeDirectory($path, 0777, true, true);
			if ($request->file('img_1')) {
				$img_1 = $request->file('img_1');
				Image::make($img_1->getRealPath())->save($path . $img_1_name);
			}
			if ($request->file('img_2')) {
				$img_2 = $request->file('img_2');
				Image::make($img_2->getRealPath())->save($path . $img_2_name);
			}

			if ($request->is_treament_plan) {
                return redirect()->route('patient.consultation.edit', $request->consultation_id)->with('success', 'Data created success');
            } else {
				return redirect()->route('para_clinic.echography.edit', $echo->id)->with('success', 'Data created success');
			}
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function getDetail(Request $request)
	{
		$row = Echography::where('echographies.id', $request->id)
		->select([
			'echographies.*',
			'patients.name_en as patient_en',
			'patients.name_kh as patient_kh',
			'physicians.name_en as physician_en',
			'physicians.name_kh as physician_kh',
			'requestedBy.name_en as requested_en',
			'requestedBy.name_kh as requested_kh',
			'paymentTypes.title_en as payment_type_en',
			'paymentTypes.title_kh as payment_type_kh',
			'echo_types.name_en as type_en',
			'echo_types.name_kh as type_kh'
		])
		->leftJoin('patients', 'patients.id', '=', 'echographies.patient_id')
		->leftJoin('data_parents AS paymentTypes', 'paymentTypes.id', '=', 'echographies.payment_type')
		->leftJoin('doctors AS physicians', 'physicians.id', '=', 'echographies.doctor_id')
		->leftJoin('doctors AS requestedBy', 'requestedBy.id', '=', 'echographies.requested_by')
		->leftJoin('echo_types', 'echo_types.id', '=', 'echographies.type')
		->first();
		if ($row) {
			$body = '';
			$tbody = '';
			$attributes = array_except(filter_unit_attr(unserialize($row->attribute) ?: []), ['status', 'amount', 'payment_type']);
			foreach ($attributes as $label => $attr) {
				$tbody .= '<tr>
								<td width="30%" class="text-right tw-bg-gray-100">'. __('form.echography.'. $label) .'</td>
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
				'print_url' => route('para_clinic.echography.print', $row->id),
			]);
		}else{
			return response()->json([
				'success' => false,
				'message' => 'Echography not found!',
			], 404);
		}
	}

	/**
	 * Print the specified Resourse.
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
		$echography->attribute = array_except(filter_unit_attr(unserialize($echography->attribute) ?: []), ['status', 'amount']);
		$data['echography'] = $echography;
		return view('echography.print', $data);
	}

	/**
	 * Show the form for editing the specified resource.
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

	public function show(Echography $echography)
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
		return view('echography.show', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(EchographyRequest $request, Echography $echography)
	{
		// serialize all post into string
		$serialize = array_except($request->all(), ['_method', '_token', 'img_1', 'img_2']);
		$request['attribute'] = serialize($serialize);
		$request['amount'] = $request->amount ?? 0;
		$request['doctor_id'] = $request->doctor_id ?? 0;
		
		$path = public_path('/images/echographies/');
		File::makeDirectory($path, 0777, true, true);
		if ($request->file('img_1')) {
			$img_1 = $request->file('img_1');
			$img_1_name = (($echography->image_1!='')? $echography->image_1 : time() .'_image_1_'. $echography->id .'.png');
			Image::make($img_1->getRealPath())->save($path . $img_1_name);
			$request['image_1'] = $img_1_name;
		}
		if ($request->file('img_2')) {
			$img_2 = $request->file('img_2');
			$img_2_name = (($echography->image_2!='')? $echography->image_2 : time() .'_image_2_'. $echography->id .'.png');
			Image::make($img_2->getRealPath())->save($path . $img_2_name);
			$request['image_2'] = $img_2_name;
		}
		if ($echography->update($request->all())) {
			return redirect()->route('para_clinic.echography.index')->with('success', 'Data update success');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Echography $echography)
	{
		$echography->status = 0;
		if ($echography->update()) {
			return redirect()->route('para_clinic.echography.index')->with('success', 'Data delete success');
		}
	}
}
