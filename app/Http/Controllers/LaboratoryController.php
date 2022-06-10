<?php

namespace App\Http\Controllers;

use App\Models\LaborType;
use App\Models\Laboratory;
use App\Models\LaborDetail;
use App\Models\Doctor;
use App\Models\Patient;
use App\Http\Requests\StoreLaboratoryRequest;
use App\Http\Requests\UpdateLaboratoryRequest;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->data['rows'] = Laboratory::select([
			'laboratories.*', 
			'patients.name_en as patient_en', 
			'patients.name_kh as patient_kh',
			'requester.name_en as requester_en',
			'requester.name_kh as requester_kh',
		])
		->where('laboratories.status', '>=' , 1)
		->leftJoin('patients', 'patients.id', '=', 'laboratories.patient_id')
		->leftJoin('doctors as requester', 'requester.id', '=', 'laboratories.requested_by')
		->orderBy('laboratories.id', 'desc')
		->get();
		return view('labor.index', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
		$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		$data['payment_type'] = getParentDataSelection('payment_type');
		$data['gender'] = getParentDataSelection('gender');
		$data['labor_type'] = LaborType::where('status', 1)->orderBy('index', 'asc')->regroupe();
		$data['is_edit'] = false;
		return view('labor.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		if (sizeof($request->labor_item_id ?? []) > 0) {
			$laboratory = new Laboratory();
			if ($labor = $laboratory->create([
				'code' => generate_code('LAB', 'laboratories'),
				'patient_id' => $request->patient_id,
				'gender' => $request->gender ?: 0,
				'age' => $request->age ?: 0,
				'requested_by' => $request->requested_by ?: auth()->user()->doctor ?? 0,
				'requested_at' => $request->requested_at ?: date('Y-m-d H:i:s'),
				'doctor_id' => $request->doctor_id ?: 0,
				'analysis_at' => $request->analysis_at ?: null,
				'amount' => $request->amount ?: 0,
				'payment_type' => $request->payment_type ?: 0,
				'payment_status' => $request->payment_status ?: 0,
				'result' => $request->result,
				'sample' => $request->sample,
				'diagnosis' => $request->diagnosis,
				'status' => 1,
			])) {
				foreach ($request->labor_item_id as $labor_item_id) {
					$detail = new LaborDetail;
					$detail->create([
						'labor_id' => $labor->id,
						'labor_item_id' => $labor_item_id,
						'value' => 0,
					]);
				}
				if ($request->is_treament_plan) {
					return redirect()->route('patient.consultation.edit', $request->consultation_id)->with('success', 'Data created success');
				} else {
					return redirect()->route('para_clinic.labor.edit', $labor->id)->with('success', 'Data created success');
				}
			}
		} else {
			if ($request->is_treament_plan) {
				return redirect()->route('patient.consultation.edit', $request->consultation_id)->with('error', 'No Test has been selected');
			} else {
				return redirect()->route('para_clinic.labor.edit', $labor->id)->with('error', 'No Test has been selected');
			}
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Laboratory $labor)
	{
		if ($labor ?? false) {
			$data['row'] = $labor;
			$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
			$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		}
		$data['gender'] = getParentDataSelection('gender');
		$data['payment_type'] = getParentDataSelection('payment_type');
		$data['labor_detail'] = $labor->detail()->get();
		$data['is_edit'] = true;
		return view('labor.show', $data);
	}

	/**
	 * Display the specified resource.
	 */
	public function getDetail(Request $request)
	{
		$row = Laboratory::where('laboratories.id', $request->id)
		->select([
			'laboratories.*',
			'patients.name_en as patient_en',
			'patients.name_kh as patient_kh',
			'patients.age as patient_age',
			'genders.title_en as patient_gender',
			'analysisBy.name_en as analysis_en',
			'analysisBy.name_kh as analysis_kh',
			'requestedBy.name_en as requested_en',
			'requestedBy.name_kh as requested_kh',
			'paymentTypes.title_en as payment_type_en',
			'paymentTypes.title_kh as payment_type_kh',
		])
		->leftJoin('patients', 'patients.id', '=', 'laboratories.patient_id')
		->leftJoin('data_parents AS paymentTypes', 'paymentTypes.id', '=', 'laboratories.payment_type')
		->leftJoin('data_parents AS genders', 'genders.id', '=', 'patients.gender')
		->leftJoin('doctors AS analysisBy', 'analysisBy.id', '=', 'laboratories.doctor_id')
		->leftJoin('doctors AS requestedBy', 'requestedBy.id', '=', 'laboratories.requested_by')
		->first();
		if ($row) {
			$tbody = '';
			$status_html = (($row->status==2)? '<span class="badge badge-primary">Completed</span>' : '<span class="badge badge-light">Incompleted</span>');
			$status_html .= (($row->payment_status==2)? '<span class="badge badge-success tw-ml-1">Paid</span>' : '<span class="badge badge-light tw-ml-1">Unpaid</span>');
			$header = '<table class="table-form table-header-info">
							<thead>
								<tr>
									<th colspan="4" class="text-left tw-bg-gray-100">Patient <span class="tw-pl-2 detail-status">'. $status_html .'</span></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-right tw-bg-gray-100">Name</td>
									<td>'. render_synonyms_name($row->patient_en, $row->patient_kh) .'</td>
									<td width="20%" class="text-right tw-bg-gray-100">Code</td>
									<td>'. $row->code .'</td>
								</tr>
								<tr>
									<td width="20%" class="text-right tw-bg-gray-100">Age</td>
									<td>'. $row->patient_age .'</td>
									<td width="20%" class="text-right tw-bg-gray-100">Gender</td>
									<td>'. $row->patient_gender .'</td>
								</tr>
								<tr>
									<td class="text-right tw-bg-gray-100">Requested by</td>
									<td>'. render_synonyms_name($row->requested_en, $row->requested_kh) .'</td>
									<td class="text-right tw-bg-gray-100">Analysis by</td>
									<td>'. render_synonyms_name($row->analysis_en, $row->analysis_kh) .'</td>
								</tr>
								<tr>
									<td class="text-right tw-bg-gray-100">Requested date</td>
									<td>'. date('d/m/Y H:i', strtotime($row->requested_at)) .'</td>
									<td class="text-right tw-bg-gray-100">Analysis date</td>
									<td>'. (($row->analysis_at)? date('d/m/Y H:i', strtotime($row->analysis_at)) : '') .'</td>
								</tr>
								<tr>
									<td class="text-right tw-bg-gray-100">Result</td>
									<td>
										<textarea class="form-control">'. $row->result .'</textarea>
									</td>
									<td class="text-right tw-bg-gray-100">Diagnosis</td>
									<td>
										<textarea class="form-control">'. $row->diagnosis .'</textarea>
									</td>
								</tr>
								<tr>
									<td class="text-right tw-bg-gray-100">Payment type</td>
									<td>'. render_synonyms_name($row->payment_type_en, $row->payment_type_en) .'</td>
									<td class="text-right tw-bg-gray-100">Amount</td>
									<td><b>'. $row->amount .' USD</b></td>
								</tr>
							</tbody>
						</table>';
			$labor_detail = $row->detail()->get();
			foreach ($labor_detail as $detail) {
				static $i = 1;
				$item = $detail->item();
				$tbody .= '<tr>
								<td class="text-center">'. $i++ .'</td>
								<td>'. render_synonyms_name($item->category()->name_en, $item->category()->name_kh) .'</td>
								<td>'. render_synonyms_name($item->name_en, $item->name_kh) .'</td>
								<th class="text-center"><strong>'. ($detail->value ?: 0) .'</strong></th>
								<td class="text-center">'. apply_markdown_character($item->unit) .'</td>
								<td class="text-center">'. $item->min_range .' - '. $item->max_range .'</td>
							</tr>';
			}
			$body = '<div class="pt-1 tw-pb-1">Detail</div>
					<table class="table-form table table-border">
						<thead>
							<tr>
								<th class="text-center">N&deg;</th>
								<th>Category</th>
								<th>Tests</th>
								<th width="15%">Result</th>
								<th width="15%">Unit</th>
								<th width="15%">Normal Range</th>
							</tr>
						</thead>
						<tbody>'. (($tbody=='')? '<tr><th colspan="7" class="text-center">No result</th></tr>' : $tbody.'<tr></tr>' ) .'</tbody>
					</table>';
			return response()->json([
				'success' => true,
				'header' => $header,
				'body' => $body,
				'print_url' => route('para_clinic.labor.print', $row->id),
			]);
		}else{
			return response()->json([
				'success' => false,
				'message' => 'Laboratory not found!',
			], 404);
		}
	}

	/**
	 * Display the specified Image.
	 */
	public function print($id)
	{
		$labor = Laboratory::select([
			'laboratories.*',
			'patients.name_kh as patient_kh',
			'patients.age as patient_age',
			'data_parents.title_en as patient_gender',
			'doctors.name_kh as doctor_kh',
			'requestedBy.name_en as requested_by_name',
		])
		->leftJoin('patients', 'patients.id', '=', 'laboratories.patient_id')
		->leftJoin('data_parents', 'data_parents.id', '=', 'patients.gender')
		->leftJoin('doctors', 'doctors.id', '=', 'laboratories.doctor_id')
		->leftJoin('doctors AS requestedBy', 'requestedBy.id', '=', 'laboratories.requested_by')
		->find($id);
		$data['labor'] = $labor;

		
		// Prepare labor detail with 2 levels of groups
		#1, get all labor detail concerned, and separate it by type id
		$labor_detail = [];
		foreach ($labor->detail()->get() ?? [] as $item) {
			$type_id = $item->item()->type;
			$labor_detail[$type_id][] = $item;
		}


		// #2, Get all template and apply Labor detail for it
		$print_result = [];
		$labor_types = LaborType::where('status', 1)->orderBy('index', 'asc')->regroupe() ?: [];
		foreach ($labor_types as $main_data) {
			$child_has_labor = [];
			
			foreach ($main_data->child as $sub_data) {
				if (in_array($sub_data->id, array_keys($labor_detail))) {
					$child_has_labor[] = [
						'type' => 'label',
						'data' => trim($sub_data->name_en, '- ')
					];
					$child_has_labor[] = [
						'type' => 'result',
						'data' => $labor_detail[$sub_data->id]
					];
				}
			}

			if (sizeof($child_has_labor) > 0) { // Check main type
				$print_result[] = [
					'type' => 'main_label',
					'data' => $main_data->name_en
				];
				array_push($print_result, ...$child_has_labor);
			} elseif (in_array($main_data->id, array_keys($labor_detail))) {
				$print_result[] = [
					'type' => 'main_label',
					'data' => $main_data->name_en
				];
				$print_result[] = [
					'type' => 'result',
					'data' => $labor_detail[$main_data->id]
				];
			}
		}

		#3, See the debug to get understand
		// dd($print_result);
		
		$data['labor_detail'] = $print_result;
		return view('labor.print', $data);
	}


	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Laboratory $labor)
	{
		if ($labor ?? false) {
			$data['row'] = $labor;
			$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
			$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		}
		$data['gender'] = getParentDataSelection('gender');
		$data['payment_type'] = getParentDataSelection('payment_type');
		$data['labor_detail'] = $labor->detail()->get();
		$data['is_edit'] = true;
		return view('labor.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Laboratory $labor)
	{
		// serialize all post into string
		$serialize = array_except($request->all(), ['_method', '_token']);
		$request['attribute'] = serialize($serialize);
		$request['amount'] = $request->amount ?? 0;

		if ($labor->update($request->all())) {
			// Do update the labor detail
			$detail_ids = $request->test_id ?: [];
			$detail_values = $request->test_value ?: [];

			if (sizeof($detail_ids) > 0) {
				foreach ($detail_ids as $index => $id) {
					LaborDetail::find($id)->update(['value' => $detail_values[$index] ?: 0]);
				}

				// Clean old data
				$detailToDelete = LaborDetail::where('labor_id', $labor->id)->whereNotIn('id', $detail_ids);
				$detailToDelete->delete();
			}

			return redirect()->route('para_clinic.labor.index')->with('success', 'Data update success');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Laboratory $labor)
	{
		$labor->status = 0;
		if ($labor->update()) {
			return redirect()->route('para_clinic.labor.index')->with('success', 'Data delete success');
		}
	}
}
