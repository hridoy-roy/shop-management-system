<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable|number',
            'email' => 'nullable|email',
            'joining_date' => 'nullable|date',
            'avatar' => 'nullable|image|max:1024',
        ];
    }
}
