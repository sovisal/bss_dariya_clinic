<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
			'name' => 'required|string|min:2|max:255',
			'phone' => 'nullable|numeric|digits_between:9,12',
			'position' => 'nullable|max:255',
			'address' => 'nullable|max:255',
			'username' => 'required|string|min:3|max:255|unique:users',
			'password' => ['required', 'confirmed', Password::defaults()],
		];
	}
}
