<?php

namespace App\Http\Requests;

use App\Models\VolumeAttribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CartRequest extends FormRequest
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
        $attribute_id = $this->input('attribute_id');

        $volume_id = $this->input('volume_id');

        return [
            'volume_id'    => 'required|exists:volumes,id',
            'attribute_id' => 'required|exists:volume_attributes,id',
            'quantity'     => ['required','gte:1',
                                    function($attr, $val, $fail) use ($volume_id, $attribute_id)
                                    {
                                        $attribute = VolumeAttribute::find($attribute_id);

                                        if(is_null($attribute))
                                        {
                                            $fail('Selected type is invalid.');
                                        }

                                        else if($attribute->volume_id != $volume_id)
                                        {
                                            $fail('Selected type is invalid.');
                                        }

                                        else if($attribute->quantity < $val)
                                        {
                                            $message = $attribute->quantity == 1
                                                ? 'Only 1 copy of this volume is available.'
                                                : 'Only ' . $attribute->quantity . ' copies of this volume are available.';
                                            $fail($message);
                                        }
                                    }
                                ],
        ];
    }

    public function messages()
    {
        return [
            'attribute_id.required' => 'Please select a type.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->with('message', $validator->errors()->first())
        );
    }
}
