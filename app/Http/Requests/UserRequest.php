<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
class UserRequest extends FormRequest
{
    /**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules() {
		return [
			'username' => 'required',
			'status' => 'required',
			'email' => [
				'required',
				'email',
				Rule::unique('users', 'email')->ignore($this->id),
			],
			'password' => 'required|min:8',
			'user_role' => 'required',
			'device_name' => 'required',
			'full_name' => 'required',
			'country' => 'required',
			'phone_number' => 'required',
			'api_token' => 'required',
			'birthday' => 'required',
		];
	}
	protected function failedValidation(Validator $validator) {
		throw new HttpResponseException(
			response()->json($validator->errors(), 422)
		);
	}
}
