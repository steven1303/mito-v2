<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class VendorUpdatePatchRequest extends FormRequest
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
            'name' => ['required'],
            'address1' => ['required'],
            'city' => ['required'],
            'phone' => ['required'],
            'npwp' => ['required'],
            'tax' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'address1.required' => 'Address is required',        
            'city.required' => 'City is required',        
            'phone.required' => 'Phone is required',        
            'npwp.required' => 'NPWP is required',
            'tax.required' => 'Tax is required',   
        ];
    }
}
