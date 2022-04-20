<?php

namespace App\Http\Controllers;

use App\Models\Usage;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\PrescriptionDetail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PrescriptionRequest;
use App\Repositories\Component\GlobalComponent;

class PrescriptionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$prescriptions = Prescription::all();
		$prescription_description = '';
		foreach ($prescriptions as $i => $prescription) {
			foreach ($prescription->prescription_details as $j => $prescription_detial) {
				if ($prescription->prescription_details->count() > 1) {
					$prescription_description .= str_replace(' on ' . date('M-D', strtotime($prescription_detial->prescription->date)), "", strip_tags($prescription_detial->description, "</p>")) . ', ';
				} else {

					$prescription_description = str_replace(' on ' . date('M-D', strtotime($prescription_detial->prescription->date)), "", strip_tags($prescription_detial->description, "</p>"));
				}
			}
		}
		$from = '2020-05-01';
		$to = '2020-05-31';
		$prescription_ids = Prescription::whereBetween('date', [$from, $to])->select('id');
		$this->data = [
			'prescription_description' => $prescription_description,
			'prescription_details' => PrescriptionDetail::whereIn('medicine_id', ['59', '60', '61', '62', '63', '64', '65'])->whereIn('prescription_id', $prescription_ids)->get(),
		];

		return view('prescription.index', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->data = [
			'code' => $this->prescription->code(),
			'medicines' => Medicine::getSelectData('id', 'name', '', 'name' ,'asc'),
			'patients' => Patient::getSelectData('id', 'name', '', 'name' ,'asc'),
			'usage' => Usage::getSelectData('id', 'name', '', 'name' ,'asc'),
		];
		return view('prescription.create', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(PrescriptionRequest $request)
	{
		$prescription = $this->prescription->create($request);
		if ($prescription) {
			// Redirect
			return redirect()->route('prescription.edit', $prescription->id)->with('success',  __('alert.message.success.crud.create'));
		}
	}

	public function save_order(Request $request, Prescription $prescription)
	{
		$order = explode(',', $request->order_ids);
		$ids = explode(',', $request->item_ids);
		for ($i = 0; $i < count($ids); $i++) {
			PrescriptionDetail::find($ids[$i])
								->update([
									'index' => $order[$i],
									'updated_by' => auth()->user()->id,
								]);
		}
		return redirect()->route('prescription.edit', $prescription->id)->with('success', __('alert.message.success.crud.update'));
	}

	public function getItemDetail(Request $request)
	{
		return response()->json([ 'prescription_detail' => PrescriptionDetail::find($request->id) ]);
	}

	public function prescriptionDetailStore(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'medicine_name' => 'required',
			'medicine_usage' => 'required',
		]);
		
		if ($validator->fails())
		{
				return response()->json(['errors'=>$validator->errors()]);
		}
		
		$prescription = Prescription::find($request->prescription_id);
		$last_item = $prescription->prescription_details()->first();
		$index = (($last_item !== null) ? $last_item->index + 1 : 1);

		$prescription_detail = PrescriptionDetail::create([
												'medicine_name' => $request->medicine_name,
												'medicine_usage' => $request->medicine_usage,
												'morning' => $request->morning ?: 0,
												'afternoon' => $request->afternoon ?: 0,
												'evening' => $request->evening ?: 0,
												'night' => $request->night ?: 0,
												'qty_days' => $request->qty_days ?: 0,
												'description' => $request->description,
												'index' => $index,
												'medicine_id' => $request->medicine_id,
												'prescription_id' => $request->prescription_id,
												'created_by' => auth()->user()->id,
												'updated_by' => auth()->user()->id,
											]);

		$json = $this->getPrescriptionPreview($prescription_detail->prescription_id)->getData();

		return response()->json([
			'success'=>'success',
			'prescription_detail' => $prescription_detail,
			'prescription_preview' => $json->prescription_detail,
		]);
	}
	
	public function prescriptionDetailUpdate(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'medicine_name' => 'required',
			'medicine_usage' => 'required',
		]);
		
		if ($validator->fails()){
				return response()->json(['errors'=>$validator->errors()]);
		}

		$prescription_detail = PrescriptionDetail::find($request->id);
		$prescription_detail->update([
			'medicine_name' => $request->medicine_name,
			'medicine_usage' => $request->medicine_usage,
			'morning' => $request->morning ?: 0,
			'afternoon' => $request->afternoon ?: 0,
			'evening' => $request->evening ?: 0,
			'night' => $request->night ?: 0,
			'qty_days' => $request->qty_days ?: 0,
			'description' => $request->description,
			'medicine_id' => $this->get_medicine_id_or_create($request->medicine_name),
			'updated_by' => auth()->user()->id,
		]);

		$json = $this->getPrescriptionPreview($prescription_detail->prescription_id)->getData();
		return response()->json([
			'success'=>'success',
			'prescription_detail' => $prescription_detail,
			'prescription_preview' => $json->prescription_detail,
		]);
	}
	
	public function getPrescriptionPreview(Request $request)
	{
		$GlobalComponent = new GlobalComponent;
		$no = 1;
		$total = 0;
		$prescription_detail = '';
		$tbody = '';

		$prescription = Prescription::find($request->id);

		$title = 'Prescription (PRE-' . str_pad($prescription->code, 6, "0", STR_PAD_LEFT) . ')';

		foreach ($prescription->prescription_details as $prescription_detail) {
			$total = ($prescription_detail->morning + $prescription_detail->afternoon + $prescription_detail->evening + $prescription_detail->night) * $prescription_detail->qty_days;
			$tbody .= '<tr>
									<td class="text-center">' . $no++ . '</td>
									<td>' . $prescription_detail->medicine_name . '</td>
									<td class="text-center">' . $prescription_detail->morning . '</td>
									<td class="text-center">' . $prescription_detail->afternoon . '</td>
									<td class="text-center">' . $prescription_detail->evening . '</td>
									<td class="text-center">' . $prescription_detail->night . '</td>
									<td class="text-center">' . $prescription_detail->qty_days . '</td>
									<td class="text-center">' . $total . '</td>
									<td class="text-center">' . $prescription_detail->medicine_usage . '</td>
									<td><small>' . $prescription_detail->description . '</small></td>
								</tr>';
		}

		$prescription_detail = '<section class="prescription-print" style="position: relative;">
			' . $GlobalComponent->PrintHeader('prescription', $prescription) . '
			<table class="table-detail" width="100%">
				<thead>
					<th class="text-center" width="5%">ល.រ</th>
					<th class="text-center">ឈ្មោះថ្នាំ</th>
					<th class="text-center" width="6%">ព្រឹក</th>
					<th class="text-center" width="6%">ថ្ងៃ</th>
					<th class="text-center" width="6%">ល្ងាច</th>
					<th class="text-center" width="6%">យប់</th>
					<th class="text-center" width="8%">ចំនួនថ្ងៃ</th>
					<th class="text-center" width="6%">សរុប</th>
					<th class="text-center" width="13%">ការប្រើប្រាស់</th>
					<th class="text-center" width="19%">កំណត់ចំណាំ</th>
				</thead>
				<tbody>
					'. $tbody .'
				</tbody>
			</table>
			<small class="remark">'. $prescription->remark .'</small>
			<br/>
			' . $GlobalComponent->FooterComeBackText('សូមយកវេជ្ជបញ្ជាមកវិញពេលមកពិនិត្យលើកក្រោយ') . '
			<table class="table-footer" style="position: absolute; bottom: 80px; " width="90%">
			' . $GlobalComponent->DoctorSignature() . '
			</table>
		</section>';
		return response()->json(['prescription_detail' => $prescription_detail, 'title' => $title]);
	}
	
	// public function prescription_detail(Prescription $prescription)
	// {
	// 	$this->data = [
	// 		'prescription' => $prescription,
	// 		'medicines' => Medicine::getSelectMedicine($prescription->medicine_id),
	// 		'prescription_preview' => $this->prescription->getPrescriptionPreview($prescription->id),
	// 	];

	// 	return view('prescription.prescription_detail', $this->data);
	// }

	public function print(Prescription $prescription)
	{

		$this->data = [
			'prescription' => $prescription,
			'prescription_preview' => $this->getPrescriptionPreview($prescription->id)->getData()->prescription_detail,
		];

		return view('prescription.print', $this->data);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Prescription $prescription)
	{
		$this->data = [
			'prescription' => $prescription,
			'medicines' => Medicine::getSelectData('id', 'name', '', 'name' ,'asc'),
			'patients' => Patient::getSelectData('id', 'name', '', 'name' ,'asc'),
			'prescription_preview' => $this->prescription->getPrescriptionPreview($prescription->id)->getData()->prescription_detail,
			'usage' => Usage::getSelectData('id', 'name', '', 'name' ,'asc'),
		];

		return view('prescription.edit', $this->data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(PrescriptionRequest $request, Prescription $prescription)
	{
		$prescription->update(GlobalComponent::MergeRequestPatient($request, [
			'date' => $request->date,
			'code' => $request->code,
			'pt_diagnosis' => $request->pt_diagnosis,
			'remark' => $request->remark,
			'updated_by' => auth()->user()->id,
		]));
		return redirect()->route('prescription.edit', $prescription->id)->with('success', __('alert.message.success.crud.update'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Prescription $prescription)
	{
		if ($prescription->delete()) {
			return back()->with('success', __('alert.message.success.crud.delete'));
		}
		return back()->with('error', __('alert.message.error.crud.delete'));
	}
}
