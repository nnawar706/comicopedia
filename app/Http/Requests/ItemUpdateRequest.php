<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemUpdateRequest extends FormRequest
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
            'genre_id'      => 'required|exists:genres,id',
            'ISBN_no'       => 'required|unique:items,ISBN_no,'.$this->route('id'),
            'title'         => 'required|string|unique:items,title',
            'detail'        => 'required|string|max:500',
            'author'        => 'required|string|max:250',
            'magazine'      => 'required|string|max:250',
            'meta_keywords' => ['required','string', 'regex:/^[\w\s]+(,\s*[\w\s]+)*$/'],
            'image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'meta_keywords.regex' => 'Keywords must be seperated by commas.',
            'ISBN_no.unique'      => 'The ISBN number is already taken.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->with('message', $validator->errors()->first())
        );
    }
}
