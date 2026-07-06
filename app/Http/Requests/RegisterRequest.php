<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:3',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],

            'phone' => [
                'required',
                'digits:10',
                'unique:users,phone',
            ],

            'password' => [
                'required',
                'min:6',
                'confirmed',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX Validation Errors
    |--------------------------------------------------------------------------
    */

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}