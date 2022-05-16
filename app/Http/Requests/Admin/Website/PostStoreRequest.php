<?php

namespace App\Http\Requests\Admin\Website;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'title' => ['required'],
            'subtitle' => ['required'],
            'slug' => ['required'],
            'futureImage' => ['required'],
            'meta_desc' => ['required'],
            'meta_keyword' => ['required '],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'subtitle.required' => 'Subtitle is required',
            'slug.required' => 'Slug is required',
            'futureImage.required' => 'Future Image is required',
            'meta_desc.required' => 'Meta Description is required',
            'meta_keyword.required' => 'Meta Keyword is required',
        ];
    }
}
