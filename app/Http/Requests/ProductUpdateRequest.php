<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
    		'title'             => 'required|string|max:255',
            'sku'               => 'required|string|max:15',
            'description'       => 'required|min:1|max:2000',
            'image'             => 'mimes:jpeg,bmp,png,gif,svg,jpg|max:5120',
            'quantity'          => 'required|numeric',
            'category'          => 'required',
            'price'             => 'required|numeric',
        ];
    }
}
