<?php

namespace App\Http\Controllers;

use App\Models\EcgType;
use App\Http\Requests\StoreEcgTypeRequest;
use App\Http\Requests\UpdateEcgTypeRequest;
use Illuminate\Http\Request;

class EcgTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['rows'] = EcgType::where('status', 1)
        ->orderBy('index', 'asc')
        ->get();
        return view('ecg_type.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ecg_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEcgTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribite'] = serialize($serialize);

        $dataParent = new EcgType();
        if ($dataParent->create([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'price' => $request->price ?: 0,
            'attribite' => $request->attribite,
            'index' => $request->index ?: 999,
            'default_form' => $request->default_form,
            'status' => 1,
        ])) {
            return redirect()->route('setting.ecg-type.index')->with('success', 'Data created success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EcgType  $ecgType
     * @return \Illuminate\Http\Response
     */
    public function show(EcgType $ecgType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EcgType  $ecgType
     * @return \Illuminate\Http\Response
     */
    public function edit(EcgType $ecgType)
    {
        append_array_to_obj($ecgType, unserialize($ecgType->attribite) ?: []);
        $data['row'] = $ecgType;
        return view('ecg_type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEcgTypeRequest  $request
     * @param  \App\Models\EcgType  $ecgType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EcgType $ecgType)
    {
        $request['status'] = 1;

        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribite'] = serialize($serialize);

        if ($ecgType->update($request->all())) {
            return redirect()->route('setting.ecg-type.index')->with('success', 'Data update success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EcgType  $ecgType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EcgType $ecgType)
    {
        $ecgType->status = 0;
        if ($ecgType->update()) {
            return redirect()->route('setting.ecg-type.index')->with('success', 'Data delete success');
        }
    }
}
