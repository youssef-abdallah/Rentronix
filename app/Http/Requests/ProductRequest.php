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
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:Product',
            'product_overview'=>'required',
            'datasheet_url'=>'required',
            'image_url'=>'required',
            'available_stock' =>'required',
            'rental_price' =>'required',
            'selling_price'=>'required',
            'subcategory_id' =>'required',
            'owner_id'=>'required'
        ];
    }
}
