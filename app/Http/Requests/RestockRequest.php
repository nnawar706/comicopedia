<?php

namespace App\Http\Requests;

use App\Models\VolumeAttribute;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RestockRequest extends FormRequest
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
            'volume_id'     => 'required|exists:volumes,id',
            'attribute_id'  => ['sometimes','nullable','integer',
                                function($attr,$val,$fail) {
                                    $volume_attribute = VolumeAttribute::find($val);

                                    if(is_null($volume_attribute) || $volume_attribute->volume_id != $this->input('volume_id'))
                                    {
                                        $fail('The selected volume is invalid.');
                                    }
                                }],
            'comment'       => 'nullable|sometimes|max:300'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->with('message', $validator->errors()->first())
        );
    }
}
