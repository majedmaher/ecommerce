<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => 'required',
            'product_name_en' => 'required',
            'product_name_ar' => 'required',
            'product_qty' => 'required',
            'product_size_en' => 'required',
            'product_size_ar' => 'required',
            'product_color_en' => 'required',
            'product_color_ar' => 'required',
            'selling_price' => 'required',
            'short_product_description_en' => 'required',
            'short_product_description_ar' => 'required',
            'long_product_description_en' => 'required',
            'long_product_description_ar' => 'required',
            'additional_information_en' => 'required',
            'additional_information_ar' => 'required',

        ];
    }

    public function message()
    {
        return [
            'category_id.required' => 'Choose Category',
            'product_name_en.required' => 'Input Product Name in English',
            'product_name_ar.required' => 'Input Product Name in Arabic',
            'product_qty.required' => 'Input Product quantity',
            'product_size_en.required' => 'Input Product Size in English',
            'product_size_ar.required' => 'Input Product Size in Arabic',
            'product_color_en.required' => 'Input Product Color in English',
            'product_color_ar.required' => 'Input Product Color in Arabic',
            'selling_price.required' => 'Input Product Selling Price',
            'short_product_description_en.required' => 'Input Short Product description in English',
            'short_product_description_ar.required' => 'Input Short Product description in Arabic',
            'long_product_description_en.required' => 'Input Long Product description in English',
            'long_product_description_ar.required' => 'Input Long Product description in Arabic',
            'additional_information_en.required' => 'Input additional information in English',
            'additional_information_ar.required' => 'Input additional information in Arabic',

        ];
    }
}
