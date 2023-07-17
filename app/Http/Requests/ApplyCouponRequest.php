<?php

namespace App\Http\Requests;

use App\Models\UserCoupon;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApplyCouponRequest extends FormRequest
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
            'code' => ['required','exists:user_coupons,code',
                function($attr,$val,$fail) {
                    $code = UserCoupon::where('status',1)->whereDate('validity','>=',Carbon::today())
                        ->where('user_id', auth()->user()->id)
                        ->where('code', $val)
                        ->first();

                    if(is_null($code))
                    {
                        $fail('The coupon code is invalid.');
                    }
                }]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->with('message', $validator->errors()->first())
        );
    }
}
