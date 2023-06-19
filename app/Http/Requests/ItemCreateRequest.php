<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemCreateRequest extends FormRequest
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
            'genre_id' => 'required|exists:genres,id',
            'title' => 'required|string|unique:items,name',
            'detail' => 'required|string|max:500',
            'author' => 'required|string|max:250',
            'magazine' => 'required|string|max:250',
            'meta_keywords' => ['required','string', 'regex:/^[\w\s]+(,\s*[\w\s]+)*$/']
        ];
    }

    public function messages()
    {
        return [
            'meta_keywords.regex' => 'Keywords must be seperated by commas.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->with('message', $validator->errors()->first())
        );
    }
}
