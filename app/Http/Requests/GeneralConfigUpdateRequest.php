<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralConfigUpdateRequest extends FormRequest
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
            'notify_admins_on_new_order'        => 'required|in:0,1',
            'email_admins_on_new_user_sign_in'  => 'required|in:0,1',
            'promo_on_new_user_sign_in'         => 'required|in:0,1',
        ];
    }
}
