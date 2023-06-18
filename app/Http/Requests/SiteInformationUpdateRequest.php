<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SiteInformationUpdateRequest extends FormRequest
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
            'name' => 'sometimes|string',
            'email' => 'sometimes|email',
            'contact' => 'sometimes',
            'logo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'favicon' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'about' => 'sometimes|string',
            'facebook_url' => 'sometimes|nullable|url',
            'instagram_url' => 'sometimes|nullable|url',
            'youtube_url' => 'sometimes|nullable|url',
            'pinterest_url' => 'sometimes|nullable|url',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->with('message', $validator->errors()->first())
        );
    }
}
