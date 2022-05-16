<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\Doctor;
use App\Models\Patient;
use App\Http\Requests\StoreLaboratoryRequest;
use App\Http\Requests\UpdateLaboratoryRequest;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$this->data['rows'] = Laboratory::select([
			'laboratories.*', 'patients.name_en as patient_en',
            'requester.name_en as requester_en',
		])
		->where('laboratories.status', 1)
		->leftJoin('patients', 'patients.id', '=', 'laboratories.patient_id')
		->leftJoin('doctors as requester', 'requester.id', '=', 'laboratories.requested_by')
		->orderBy('laboratories.id', 'desc')
		->get();
		return view('labor.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
		$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		$data['payment_type'] = getParentDataSelection('payment_type');
        $data['gender'] = getParentDataSelection('gender');
		$data['is_edit'] = false;
		return view('labor.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLaboratoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribite'] = serialize($serialize);

        $laboratory = new Laboratory();
        if ($labor = $laboratory->create([
            // 'code' => $request->code,
            'patient_id' => $request->patient_id,
            'gender' => $request->gender,
            'age' => $request->age ?: 0,
            'requested_by' => $request->requested_by,
            'requested_at' => $request->requested_at ?: date('Y-m-d H:i:s'),
            'doctor_id' => $request->doctor_id,
            'analysis_at' => $request->analysis_at ?: null,
            'amount' => $request->amount ?: 0,
            'payment_type' => $request->payment_type,
            'payment_status' => $request->payment_status ?: 0,
            'result' => $request->result,
            'sample' => $request->sample,
            'diagnosis' => $request->diagnosis,
            'attribite' => $request->attribite,
            'status' => 1,
        ])) {
            return redirect()->route('para_clinic.labor.edit', $labor->id)->with('success', 'Data created success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function show(Laboratory $laboratory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
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
		$data['is_edit'] = true;
		return view('labor.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLaboratoryRequest  $request
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laboratory $labor)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribute'] = serialize($serialize);
        $request['amount'] = $request->amount ?? 0;

        if ($labor->update($request->all())) {
            return redirect()->route('para_clinic.labor.index')->with('success', 'Data update success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laboratory $labor)
    {
        $labor->status = 0;
		if ($labor->update()) {
			return redirect()->route('para_clinic.labor.index')->with('success', 'Data delete success');
		}
    }
}
