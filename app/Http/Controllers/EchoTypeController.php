<?php

namespace App\Http\Controllers;

use App\Models\EchoType;
use App\Http\Requests\StoreEchoTypeRequest;
use App\Http\Requests\UpdateEchoTypeRequest;
use Illuminate\Http\Request;

class EchoTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['rows'] = EchoType::where('status', 1)
                                ->orderBy('index', 'asc')
                                ->get();
        return view('echo_type.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('echo_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEchoTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribite'] = serialize($serialize);

        $dataParent = new EchoType();
        if ($dataParent->create([
            'name_en' => $request->name_en,
            'name_kh' => $request->name_kh,
            'price' => $request->price ?: 0,
            'attribite' => $request->attribite,
            'index' => $request->index ?: 999,
            'default_form' => $request->default_form,
            'status' => 1,
        ])) {
            return redirect()->route('setting.echo-type.index')->with('success', 'Data created success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EchoType  $echoType
     * @return \Illuminate\Http\Response
     */
    public function show(EchoType $echoType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EchoType  $echoType
     * @return \Illuminate\Http\Response
     */
    public function edit(EchoType $echoType)
    {
        append_array_to_obj($echoType, unserialize($echoType->attribite) ?: []);
        $data['row'] = $echoType;
        return view('echo_type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEchoTypeRequest  $request
     * @param  \App\Models\EchoType  $echoType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EchoType $echoType)
    {
        $request['status'] = 1;

        // serialize all post into string
        $serialize = array_except($request->all(), ['_method', '_token']);
        $request['attribite'] = serialize($serialize);

        if ($echoType->update($request->all())) {
            return redirect()->route('setting.echo-type.index')->with('success', 'Data update success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EchoType  $echoType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EchoType $echoType)
    {
        $echoType->status = 0;
        if ($echoType->update()) {
            return redirect()->route('setting.echo-type.index')->with('success', 'Data delete success');
        }
    }
}
