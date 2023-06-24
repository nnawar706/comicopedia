<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MultipleImageRequest extends FormRequest
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
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpg,png,jpeg,svg,gif|max:2048'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
//            redirect()->back()->with('message', $validator->errors()->first())
            response()->json([$validator->errors()->all()])
        );
    }
}
