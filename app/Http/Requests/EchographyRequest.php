<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EchographyRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			// 'type' => 'required|numeric',
			// 'patient_id' => 'required|numeric',
			// 'doctor_id' => 'required|numeric',
			// 'payment_type' => 'required|numeric',
			// 'requested_by' => 'required|numeric',
			// 'requested_at' => 'required|date',
			// 'img_1' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
			// 'img_2' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
		];
	}
}
