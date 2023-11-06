<?php

namespace App\Http\Requests\Admin\CategorySpecification;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'category_id' => 'required|integer',
			'specification_ids' => 'required|array',
			'specification_ids.*' => 'required|integer'
		];
	}
}
