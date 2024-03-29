<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class StockMasterUpdatePatchRequest extends FormRequest
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
            'stock_no' => ['required'],
            'name' => ['required'],
            'bin' => ['required'],
            'min_soh' => ['max:99999'],
            'max_soh' => ['max:99999'],
            'harga_modal' => ['max:9999999'],
            'harga_jual' => ['max:99999'],
        ];
    }

    public function messages()
    {
        return [
            'stock_no.required' => 'Stock Number is required',
            'name.required' => 'Stock Name is required',  
            'bin.required' => 'NPWP is required',   
            'min_soh.regex' => 'Min SOH format must Decimal (9.999)',   
            'max_soh.regex' => 'Max SOH format must Decimal (9.999)',   
            'harga_modal.regex' => 'Format must Decimal (9.999)',   
            'harga_jual.regex' => 'Format must Decimal (9.999)',   
        ];
    }
}
