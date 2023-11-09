<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
			'id' => 'required|integer',
			'images' => 'nullable|array',
			'title' => 'required|string|min:3|max:255',
			'category_id' => 'required|integer',
			'specification_ids' => 'required|array',
			'specification_ids.*' => 'required|integer',
			'price_old' => 'nullable|integer',
			'price_now' => 'required|integer',
			'tags' => 'required|array',
			'tags.*' => 'required',
			'hit' => 'required|integer',
			'content' => 'nullable|string',
			'status' => 'required|integer',
		];
	}
}
