<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
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
            'shop_name' => 'required',
            'shop_email' => 'nullable',
            'shop_phone_one' => 'nullable',
            'shop_phone_two' => 'nullable',
            'shop_mobile_one' => 'nullable',
            'shop_mobile_two' => 'nullable',
            'shop_address' => 'nullable',
            'shop_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:512'],
        ];
    }
}
