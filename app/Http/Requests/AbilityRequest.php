<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AbilityRequest extends FormRequest
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

	public function withValidator($validator)
	{
		// dd($this->all());
		if (!$validator->fails() && $this->old_category && count($this->old_category)>0){
			foreach ($this->old_name as $i => $old_name) {
				$data = ['name' => $old_name, 'label' => $this->old_label[$i], 'category' => $this->old_category[$i]];
				$newValidator = Validator::make($data, [
					'name' => ['required', 'min:3', 'max:255', Rule::unique('abilities')->ignore($this->old_ability_id[$i])],
					'label' => ['required', 'min:3', 'max:255'],
					'category' => ['required']
				]);
				$newValidator->validate();
			}
		}
		if (!$validator->fails() && $this->category && count($this->category)>0){
			foreach ($this->name as $k => $name) {
				$data = ['name' => $name, 'label' => $this->label[$k], 'category' => $this->category[$k]];
				$newValidator = Validator::make($data, [
					'name' => ['required', 'min:3', 'max:255', 'unique:abilities'],
					'label' => ['required', 'min:3', 'max:255'],
					'category' => ['required']
				]);
				$newValidator->validate();
			}
		}
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'module' => ['required', 'string', 'min:3', 'max:255', Rule::unique('ability_modules')->ignore($this->ability_module)],
		];
	}
}
