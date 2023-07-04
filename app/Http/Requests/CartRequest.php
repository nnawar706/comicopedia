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

        return [
            'volume_id'    => 'required|exists:volumes,id',
            'attribute_id' => 'required|exists:volume_attributes,id',
            'quantity'     => ['required','min:1',
                                    function($attr, $val, $fail) use ($attribute_id) {
                                        $attribute = VolumeAttribute::findOrFail($attribute_id);

                                        if($attribute->volume_id != request()->input('volume_id'))
                                        {
                                            $fail('Selected type is invalid.');
                                        }

                                        if($attribute->quantity < $val)
                                        {
                                            if($attribute->quantity == 1){
                                                $fail('Only ' . $attribute->quantity . ' copy of this volume is available.');
                                            } else {
                                                $fail('Only ' . $attribute->quantity . ' copies of this volume is available.');
                                            }

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
