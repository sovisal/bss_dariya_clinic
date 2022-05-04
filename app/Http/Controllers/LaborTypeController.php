<?php

namespace App\Http\Controllers;

use App\Models\LaborType;
use App\Http\Requests\StoreLaborTypeRequest;
use App\Http\Requests\UpdateLaborTypeRequest;

class LaborTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLaborTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLaborTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaborType  $laborType
     * @return \Illuminate\Http\Response
     */
    public function show(LaborType $laborType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaborType  $laborType
     * @return \Illuminate\Http\Response
     */
    public function edit(LaborType $laborType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLaborTypeRequest  $request
     * @param  \App\Models\LaborType  $laborType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLaborTypeRequest $request, LaborType $laborType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaborType  $laborType
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaborType $laborType)
    {
        //
    }
}
