<?php

namespace App\Http\Controllers;

use App\Models\XrayType;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Xray;
use App\Http\Requests\StoreXrayRequest;
use App\Http\Requests\UpdateXrayRequest;
use Illuminate\Http\Request;

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
     *
     * @param  \App\Http\Requests\StoreXrayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $xray = new Xray();
        if ($request->type) {
            $xray_type = XrayType::where('id', $request->type)->first();
        }
        if ($record = $xray->create([
            'code' => generate_code('X'),
            'type' => $request->type,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'requested_by' => $request->requested_by ?? 0,
            'payment_type' => $request->payment_type ?? 0,
            'payment_status' => 0,
            'requested_at' => $request->requested_at,
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
     *
     * @param  \App\Models\Xray  $xray
     * @return \Illuminate\Http\Response
     */
    public function show(Xray $xray)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Xray  $xray
     * @return \Illuminate\Http\Response
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
     *
     * @param  \App\Http\Requests\UpdateXrayRequest  $request
     * @param  \App\Models\Xray  $xray
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Xray $xray)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribute'] = serialize($serialize);

        if ($xray->update($request->all())) {
            return redirect()->route('para_clinic.xray.index')->with('success', 'Data update success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Xray  $xray
     * @return \Illuminate\Http\Response
     */
    public function destroy(Xray $xray)
    {
        $xray->status = 0;
        if ($xray->update()) {
            return redirect()->route('para_clinic.xray.index')->with('success', 'Data delete success');
        }
    }
}
