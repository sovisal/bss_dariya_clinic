<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data = [
			'consultations' => [0,1,2,3,4,5,6,7,8,9]
		];
		return view('consultation.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Consultation $consultation)
	{
		$patient = Patient::find(request()->patient) ?? null;
		$data = [
			'patient' => $patient,
			'doctors' => Doctor::orderBy('name_kh', 'asc')->get(),
			'payment_types' => getParentDataSelection('payment_type')
		];
		return view('consultation.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		dd($request);

		return redirect()->route('consultation.index')->with('success', __('alert.message.success.crud.create'));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Consultation $consultation)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	// public function update(Request $request, Consultation $consultation)
	// {
	// 	return redirect()->route('consultation.index')->with('success', __('alert.message.success.crud.create'));
	// }

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Consultation $consultation)
	{
		if ($consultation->delete()) {
			return back()->with('success', __('alert.message.success.crud.delete'));
		}
		return back()->with('error', __('alert.message.error.crud.delete'));
	}

}
