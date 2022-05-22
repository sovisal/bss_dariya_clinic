<?php

namespace App\Http\Controllers;

use App\Models\EcgType;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Ecg;
use App\Http\Requests\StoreEcgRequest;
use App\Http\Requests\UpdateEcgRequest;
use Illuminate\Http\Request;

class EcgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['rows'] = Ecg::where('ecgs.status', '>=' , 1)
        ->select([
            'ecgs.*', 'patients.name_en as patient_en', 'doctors.name_en as doctor_en',
            'ecg_types.name_en as type_en'
        ])
        ->leftJoin('patients', 'patients.id', '=', 'ecgs.patient_id')
        ->leftJoin('doctors', 'doctors.id', '=', 'ecgs.doctor_id')
        ->leftJoin('ecg_types', 'ecg_types.id', '=', 'ecgs.type')
        ->orderBy('ecgs.id', 'desc')
        ->get();
        return view('ecg.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['type'] = EcgType::where('status', 1)->orderBy('index', 'asc')->get();
        $data['patient'] = Patient::orderBy('name_en', 'asc')->get();
        $data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
        $data['payment_type'] = getParentDataSelection('payment_type');
        $data['is_edit'] = false;
        return view('ecg.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEcgRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ecg = new Ecg();
        if ($request->type) {
            $ecg_type = EcgType::where('id', $request->type)->first();
        }
        if ($record = $ecg->create([
            'code' => generate_code('ECG'),
            'type' => $request->type,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'requested_by' => $request->requested_by ?? 0,
            'payment_type' => $request->payment_type ?? 0,
            'payment_status' => 0,
            'requested_at' => $request->requested_at,
            'amount' => $request->amount ?: ($ecg_type ? $ecg_type->price : 0),
            'attribute' => $ecg_type ? $ecg_type->attribite : null,
            'status' => 1,
        ])) {
            if ($request->is_treament_plan) {
                return redirect()->route('patient.consultation.edit', $request->consultation_id)->with('success', 'Data created success');
            } else {
                return redirect()->route('para_clinic.ecg.edit', $record->id)->with('success', 'Data created success');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ecg  $ecg
     * @return \Illuminate\Http\Response
     */
    public function show(Ecg $ecg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ecg  $ecg
     * @return \Illuminate\Http\Response
     */
    public function edit(Ecg $ecg)
    {
        append_array_to_obj($ecg, unserialize($ecg->attribute) ?: []);
        if ($ecg ?? false) {
            $data['row'] = $ecg;
            $data['type'] = EcgType::where('status', 1)->orderBy('index', 'asc')->get();
            $data['patient'] = Patient::orderBy('name_en', 'asc')->get();
            $data['doctor'] = Doctor::orderBy('name_en', 'asc')->get();
        } 
        $data['payment_type'] = getParentDataSelection('payment_type');
        $data['is_edit'] = true;
        return view('ecg.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEcgRequest  $request
     * @param  \App\Models\Ecg  $ecg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ecg $ecg)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribute'] = serialize($serialize);

        if ($ecg->update($request->all())) {
            return redirect()->route('para_clinic.ecg.index')->with('success', 'Data update success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ecg  $ecg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ecg $ecg)
    {
        $ecg->status = 0;
        if ($ecg->update()) {
            return redirect()->route('para_clinic.ecg.index')->with('success', 'Data delete success');
        }
    }
}
