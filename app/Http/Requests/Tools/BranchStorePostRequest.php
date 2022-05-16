<?php

namespace App\Http\Requests\Tools;

use Illuminate\Foundation\Http\FormRequest;

class BranchStorePostRequest extends FormRequest
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
            'city' => ['required'],
            'phone' => ['required'],
            'npwp' => ['required'],
            'address' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'city.required' => 'City is required',
            'phone.required' => 'Phone is required',
            'npwp.required' => 'NPWP is required',
            'address.required' => 'Address is required',
        ];
    }
}
