<?php

namespace App\Http\Requests\Ordering;

use Illuminate\Foundation\Http\FormRequest;

class PoStockStorePostRequest extends FormRequest
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
            'spbd' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'spbd.required' => 'SPBD is required',
        ];
    }
}
