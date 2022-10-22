<?php

namespace App\Http\Requests\Ordering;

use Illuminate\Foundation\Http\FormRequest;

class PoStockUpdatePatchRequest extends FormRequest
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
        'vendor' => ['required','not_in:0'],
        ];
    }

    public function messages()
    {
        return [
            'vendor.required' => 'Vendor is required',
            'vendor.not_in' => 'Vendor is required',
        ];
    }
}
