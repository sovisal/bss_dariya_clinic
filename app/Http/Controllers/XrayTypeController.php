<?php

namespace App\Http\Controllers;

use App\Models\XrayType;
use App\Http\Requests\StoreXrayTypeRequest;
use App\Http\Requests\UpdateXrayTypeRequest;
use Illuminate\Http\Request;

class XrayTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['rows'] = XrayType::where('status', 1)
        ->orderBy('index', 'asc')
        ->get();
        return view('xray_type.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('xray_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreXrayTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribite'] = serialize($serialize);

        $dataParent = new XrayType();
        if ($dataParent->create([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'price' => $request->price ?: 0,
            'attribite' => $request->attribite,
            'index' => $request->index ?: 999,
            'default_form' => $request->default_form,
            'status' => 1,
        ])) {
            return redirect()->route('setting.xray-type.index')->with('success', 'Data created success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\XrayType  $xrayType
     * @return \Illuminate\Http\Response
     */
    public function show(XrayType $xrayType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\XrayType  $xrayType
     * @return \Illuminate\Http\Response
     */
    public function edit(XrayType $xrayType)
    {
        append_array_to_obj($xrayType, unserialize($xrayType->attribite) ?: []);
        $data['row'] = $xrayType;
        return view('xray_type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateXrayTypeRequest  $request
     * @param  \App\Models\XrayType  $xrayType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, XrayType $xrayType)
    {
        $request['status'] = 1;

        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribite'] = serialize($serialize);

        if ($xrayType->update($request->all())) {
            return redirect()->route('setting.xray-type.index')->with('success', 'Data update success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\XrayType  $xrayType
     * @return \Illuminate\Http\Response
     */
    public function destroy(XrayType $xrayType)
    {
        $xrayType->status = 0;
        if ($xrayType->update()) {
            return redirect()->route('setting.xray-type.index')->with('success', 'Data delete success');
        }
    }
}
