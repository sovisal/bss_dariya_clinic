<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\Doctor;
use App\Models\Patient;
use App\Http\Requests\StoreLaboratoryRequest;
use App\Http\Requests\UpdateLaboratoryRequest;

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
        // $data['type'] = EchoType::where('status', 1)->orderBy('index', 'asc')->get();
		$data['patient'] = Patient::orderBy('name_en', 'asc')->get();
		$data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
		$data['payment_type'] = getParentDataSelection('payment_type');
		$data['is_edit'] = false;
		return view('labor.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLaboratoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLaboratoryRequest $request)
    {
        //
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
    public function edit(Laboratory $laboratory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLaboratoryRequest  $request
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLaboratoryRequest $request, Laboratory $laboratory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laboratory  $laboratory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laboratory $laboratory)
    {
        //
    }
}
