<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdatePatchRequest extends FormRequest
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
            'ktp' => ['required'],
            'bod' => ['required','date_format:d/m/Y'],
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
            'ktp.required' => 'KTP is required',        
            'bod.required' => 'Birthday is required',        
            'bod.date_format' => 'Date format is dd/mm/yyyy',        
        ];
    }
}
