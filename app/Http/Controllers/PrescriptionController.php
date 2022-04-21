<?php

namespace App\Http\Controllers;

use App\Models\Usage;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\DataParent;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\PrescriptionDetail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PrescriptionRequest;
use App\Repositories\Component\GlobalComponent;

class PrescriptionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$this->data = [
			'prescriptions' => Prescription::orderBy('id', 'desc')->get()
		];

		return view('prescription.index', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$this->data = [
			'medicines' => Medicine::orderBy('name', 'asc')->get(),
			'patients' => Patient::orderBy('name_kh' ,'asc'),
			'usages' => DataParent::Usage()->orderBy('title_en', 'asc')->get(),
		];
		return view('prescription.create', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(PrescriptionRequest $request)
	{
		dd($request->all());
		
		// return redirect()->route('prescription.edit', $prescription->id)->with('success',  __('alert.message.success.crud.create'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Prescription $prescription)
	{
		$this->data = [
			'prescription' => $prescription,
			'medicines' => Medicine::orderBy('name', 'asc')->get(),
			'patients' => Patient::orderBy('name_kh' ,'asc'),
			'usages' => DataParent::Usage()->orderBy('title_en', 'asc')->get(),
		];

		return view('prescription.edit', $this->data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(PrescriptionRequest $request, Prescription $prescription)
	{
		dd($request->all());
		// return redirect()->route('prescription.edit', $prescription->id)->with('success', __('alert.message.success.crud.update'));
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Prescription $prescription)
	{
		if ($prescription->delete()) {
			return back()->with('success', __('alert.message.success.crud.delete'));
		}
		return back()->with('error', __('alert.message.error.crud.delete'));
	}
}
