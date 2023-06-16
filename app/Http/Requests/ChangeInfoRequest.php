<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangeInfoRequest extends FormRequest
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
            'email' => 'required|email|unique:admins,email,'.auth()->guard('admin')->user()->id,
            'contact' => ['required','unique:admins,contact,'.auth()->guard('admin')->user()->id,
                            'regex:/^(?:\+88|88)?(01[3-9]\d{8})$/'],
        ];
    }

    public function messages()
    {
        return [
            'contact.regex'     => 'Please enter a valid contact number',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->with('message', $validator->errors()->first())
        );
    }
}
