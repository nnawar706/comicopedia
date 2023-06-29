<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class VolumeCreateRequest extends FormRequest
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
        $item_id = $this->input('item_id');

        $rules = [
            'item_id' => 'required|exists:items,id',
            'catalogue_id' => 'required|exists:catalogues,id',
            'title' => ['required','string',
                Rule::unique('volumes')->where(function ($query) use ($item_id) {
                    return $query->where('item_id', $item_id);
                })
            ],
            'isbn' => 'required|string|unique:volumes,isbn',
            'details' => 'required|string|max:1000',
            'release_date' => 'sometimes',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'sometimes|numeric|lte:100',
            'discount_valid_till' => 'sometimes',
            'cost' => 'required|numeric',
        ];

        if($this->input('catalogue_id') == 5)
        {
            $rules['discount'] = 'required';
            $rules['discount_valid_till'] = 'required';
        }

        if($this->input('catalogue_id') == 2)
        {
            $rules['release_date'] = 'required|after:'.date('Ymd');
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'discount.lte' => 'The discount percentage must not be greater than 100.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->with('message', $validator->errors()->first())
        );
    }
}
