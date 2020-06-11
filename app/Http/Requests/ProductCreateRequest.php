<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
                   
            'code' => 'required|unique:categories',
            'name' => 'required|min:10', 
            'weight' => 'required', 
            'price' => 'required',  
            'description' => 'required|min:20|max:50',  
            'select_category'=> 'required',
            'photo_product_1' => 'required|mimes:jpeg,png',
            'photo_product_2' => 'required|mimes:jpeg,png',
            'photo_product_3' => 'required|mimes:jpeg,png',  
            'photo_product_1_description'=>  'required|min:10|max:50',   
            'photo_product_2_description'=>  'required|min:10|max:50',   
            'photo_product_3_description'=>  'required|min:10|max:50',   

        ];
    }
}
