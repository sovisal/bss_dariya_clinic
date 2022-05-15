<?php

namespace App\Http\Controllers;

use App\Models\LaborDetail;
use App\Http\Requests\StoreLaborDetailRequest;
use App\Http\Requests\UpdateLaborDetailRequest;

class LaborDetailController extends Controller
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
     * @param  \App\Http\Requests\StoreLaborDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLaborDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaborDetail  $laborDetail
     * @return \Illuminate\Http\Response
     */
    public function show(LaborDetail $laborDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaborDetail  $laborDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(LaborDetail $laborDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLaborDetailRequest  $request
     * @param  \App\Models\LaborDetail  $laborDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLaborDetailRequest $request, LaborDetail $laborDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaborDetail  $laborDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaborDetail $laborDetail)
    {
        //
    }
}
