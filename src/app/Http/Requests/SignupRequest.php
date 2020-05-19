<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    /**
     * Custom request class for Signup
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Adding the mandatory fields and other validation
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|between:3,64|email|unique:users',
            'password' => 'required|confirmed'
        ];
    }
}
