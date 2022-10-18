<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class AdjustmentDetailUpdatePatchRequest extends FormRequest
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
            'stock_master' => ['required'],
            'in_qty' => ['required'],
            'out_qty' => ['required'],
            'harga_modal' => ['required'],
            'harga_jual' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'stock_master.required' => 'Stock Master is required',
            'in_qty.required' => 'In QTY is required',
            'out_qty.required' => 'Out QTY is required',
            'harga_modal.required' => 'Harga Modal is required',
            'harga_jual.required' => 'Harga Jual is required',
        ];
    }
}
