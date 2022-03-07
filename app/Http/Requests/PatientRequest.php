<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
			'name_kh' => 'required|string|min:2|max:255',
			'name_en' => 'nullable|string|min:2|max:255',
			'email' => 'nullable|email',
			'phone' => 'nullable|numeric|digits_between:6,20',
			'date_of_birth' => 'nullable|date',
			'registered_at' => 'required|date',
			'education' => 'nullable|max:255',
			'position' => 'nullable|max:255',
			'enterprise' => 'nullable|max:255',
			'father_name' => 'nullable|max:255',
			'father_position' => 'nullable|max:255',
			'mother_name' => 'nullable|max:255',
			'mother_position' => 'nullable|max:255',
			'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
			'house_no' => 'nullable|max:255',
			'street_no' => 'nullable|max:255',
			'zip_code' => 'nullable|max:255',
		];
	}
}
