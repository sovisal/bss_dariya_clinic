<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medicine;
use App\Models\DataParent;
use App\Models\Prescription;
use App\Models\Doctor;
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
		$this->data['rows'] = Prescription::select([
								'prescriptions.*', 'patients.name_en as patient_en',
								'doctors.name_en as doctor_en',
							])
							->where('prescriptions.status', '>=', 1)
							->leftJoin('patients', 'patients.id', '=', 'prescriptions.patient_id')
							->leftJoin('doctors', 'doctors.id', '=', 'prescriptions.doctor_id')
							->get();
		return view('prescription.index', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
		$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		$data['is_edit'] = false;
		return view('prescription.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		// serialize all post into string
		$serialize = array_except($request->all(), ['_method', '_token']);
		$request['attribite'] = serialize($serialize);

		$prescription = new Prescription();
		if ($pre = $prescription->create([
			// 'code' => $request->code,
			'patient_id' => $request->patient_id,
			'requested_by' => $request->requested_by ?: 0,
			'requested_at' => $request->requested_at ?: date('Y-m-d H:i:s'),
			'doctor_id' => $request->doctor_id ?: 0,
			'analysis_at' => $request->analysis_at ?: null,
			'diagnosis' => $request->diagnosis,
			'attribite' => $request->attribite,
			'status' => 1,
		])) {
			$detail = new PrescriptionDetail;
			// Test Data
			$detail->create([
				'prescription_id' => $pre->id,
				'medicine_id' => 1,
				'qty' => 0,
			]);

			return redirect()->route('prescription.edit', $pre->id)->with('success', 'Data created success');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Prescription $prescription)
	{
		if ($prescription ?? false) {
			$data['row'] = $prescription;
			$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
			$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
			$data['medicine'] = Medicine::orderBy('name', 'asc')->get();
			$data['usages'] = getParentDataSelection('comsumption');
			$data['time_usage'] = getParentDataSelection('time_usage');
		}
		$data['prescription_detail'] = $prescription->detail()->get();
		$data['is_edit'] = true;
		return view('prescription.edit', $data);
	}

	public function show(Prescription $prescription)
	{
		if ($prescription ?? false) {
			$data['row'] = $prescription;
			$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
			$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
			$data['medicine'] = Medicine::orderBy('name', 'asc')->get();
			$data['usages'] = getParentDataSelection('comsumption');
			$data['time_usage'] = getParentDataSelection('time_usage');
		}
		$data['prescription_detail'] = $prescription->detail()->get();
		$data['is_edit'] = true;
		return view('prescription.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Prescription $prescription)
	{
		// serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribute'] = serialize($serialize);

        if ($prescription->update($request->all())) {
            // Do update the labor detail
            $detail_ids = $request->test_id ?: [];
			$detail_values = [];

			// #1, Bind values from post
			foreach ($detail_ids as $index => $id) {
				$detail_values[$id] = [
					'id'			=> $id,
					'medicine_id' 	=> $request->medicine_id[$index] ?: 0,
					'qty' 			=> $request->qty[$index] ?: 0,
					'upd' 			=> $request->upd[$index] ?: 0,
					'nod' 			=> $request->nod[$index] ?: 0,
					'total' 		=> $request->total[$index] ?: 0,
					'unit' 			=> $request->unit[$index] ?: '',
					'usage_id' 		=> $request->usage_id[$index] ?: 0,
					'usage_times' 	=> [],
					'other' 		=> $request->other[$index] ?: '',
				];
			}

			// #2, Bind time usage values from checkbox
			$time_usage = getParentDataSelection('time_usage');
			$detail_values = array_map(function ($val) use ($time_usage, $request) {
				foreach ($time_usage as $tm_id => $tm_name) {
					if (isset($request->{'time_usage_' .$val['id']. '_' . $tm_id})) {
						$val['usage_times'][] = $tm_id;
					}
				}
				$val['usage_times'] = implode(',', $val['usage_times'] ?: []);
				return $val;
			}, $detail_values);

			// #3, Insert into database
			foreach ($detail_values as $id => $val) {
				PrescriptionDetail::find($id)->update($val);
			}

			// #4, Clean old data when clicked on icon trast/delete
            if (sizeof($detail_ids) > 0) {
                $detailToDelete = PrescriptionDetail::where('prescription_id', $prescription->id)->whereNotIn('id', $detail_ids);
                $detailToDelete->delete();
            }

            return redirect()->route('prescription.index')->with('success', 'Data update success');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Prescription $prescription)
	{
		$prescription->status = 0;
		if ($prescription->update()) {
			return redirect()->route('prescription.index')->with('success', 'Data delete success');
		}
	}
}
