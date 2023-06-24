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
        $type = $this->route('id');

        $rules = [
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpg,png,jpeg,svg,gif|max:2048'
        ];

        if($type == 1)
        {
            $rules['images.*'] = 'dimensions:width=970,height=250';
        }

        else if($type == 2)
        {
            $rules['images.*'] = 'dimensions:width=336,height=280';
        }

        else if($type == 3)
        {
            $rules['images.*'] = 'dimensions:width=970,height=90';
        }

        else if($type == 4)
        {
            $rules['images.*'] = 'dimensions:width=120,height=240';
        }

        else if($type == 5)
        {
            $rules['images.*'] = 'dimensions:width=120,height=240';
        }

        else if($type == 6)
        {
            $rules['images.*'] = 'dimensions:width=160,height=600';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'images.*.dimensions' => 'Dimensions of the selected images are not valid.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->with('message', $validator->errors()->first())
//            response()->json([$validator->errors()->all()])
        );
    }
}
