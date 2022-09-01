<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'coupon_name' => 'required',
            'coupon_discount' => 'required|numeric',
            'coupon_validity' => 'required|date',
        ];
    }
    public function message()
    {
        return [
            'coupon_name.required' => 'Input Coupon Name',
            'coupon_discount.required' => 'Input Coupon Discount',
            'coupon_discount.numeric' => 'Input Coupon Discount as number',
            'coupon_validity.required' => 'Input Coupon Validity',
            'coupon_validity.date' => 'Input Coupon Validity as Date',
        ];
    }
}
