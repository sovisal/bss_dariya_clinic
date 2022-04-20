<?php

namespace App\Http\Controllers;

use App\Models\DataParent;
use App\Http\Requests\StoreDataParentRequest;
use App\Http\Requests\UpdateDataParentRequest;
use Illuminate\Http\Request;

class DataParentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$this->data = [
			'parent' => $request->parent ?: 'blood_type'
		];
		return view('data_parent.index', $this->data);
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
	 * @param  \App\Http\Requests\StoreDataParentRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreDataParentRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\DataParent  $dataParent
	 * @return \Illuminate\Http\Response
	 */
	public function show(DataParent $dataParent)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\DataParent  $dataParent
	 * @return \Illuminate\Http\Response
	 */
	public function edit(DataParent $dataParent)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateDataParentRequest  $request
	 * @param  \App\Models\DataParent  $dataParent
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateDataParentRequest $request, DataParent $dataParent)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\DataParent  $dataParent
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(DataParent $dataParent)
	{
		//
	}
}
