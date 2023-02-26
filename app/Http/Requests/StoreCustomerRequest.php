<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'customer_id' => 'nullable',
            'shop_name' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable|integer',
            'email' => 'nullable|email',
            'joining_date' => 'nullable|date',
            'avatar' => 'nullable|image|max:1024',
        ];
    }
}
