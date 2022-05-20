<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
    public function rules(){
        return [
            'phone'     => 'required|digits_between:9,20',
            'email'     => 'required|string|email:rfc,dns|max:255',
            'address'   => 'required|string|max:255',
            'facebook'  => 'url',
            'twitter'   => 'url',
            'instagram' => 'url',
            'linkedin'  => 'url',
        ];
    }
}