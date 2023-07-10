<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class PlaceOrderRequest extends FormRequest
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
            'address'     => 'required|string',
            'contact'     => ['required','regex:/^(?:\+88|88)?(01[3-9]\d{8})$/'],
            'password'    => ['required','string','min:8',
                                function($attr,$val,$fail) {
                                    if(!Hash::check($val,auth()->user()->password))
                                    {
                                        $fail('Verification failed.');
                                    }
                                }],
            'email'       => ['required','email',
                                function($attr,$val,$fail) {
                                    if($val != auth()->user()->email)
                                    {
                                        $fail('Verification failed.');
                                    }
                                }],
            'comment'     => 'sometimes|string|max:300',
            'terms_check' => 'required|in:1'
        ];
    }

    public function messages()
    {
        return [
            'contact.regex'         => 'The contact field is invalid.',
            'terms_check.required'  => 'You must agree to our terms and conditions.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->with('message', $validator->errors()->first())
        );
    }
}
