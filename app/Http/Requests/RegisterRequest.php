<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'device_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|regex:/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&])/|min:6|max:24', //|confirmed',
            'role_id' => 'required|numeric|min:2|max:2',
            'firebase_token' => 'required',
            'full_name' => 'required|alpha|min:3|max:14',
            'username' => 'required|alpha|min:3|max:14',

            'birthday' => 'required|date',
            'country' => 'required|min:4|max:24',
        ];
    }
}
