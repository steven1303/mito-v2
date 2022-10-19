<?php

namespace App\Http\Requests\Ordering;

use Illuminate\Foundation\Http\FormRequest;

class SpbdDetailStorePostRequest extends FormRequest
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
            'qty' => ['required'],
        ];
    }
}
