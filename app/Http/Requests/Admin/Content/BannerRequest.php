<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                'title'=>'required|string|max:100|min:2',
                'url'=>'required|string',
                'image'=>'required|image|mimes:jpg,png,jpeg,gif',
                'position'=>'required|numeric',
                'status'=>'required|numeric|in:1,0',
            ];
        }
        return [
            'title'=>'required|string|max:100|min:2',
            'url'=>'required|string',
            'image'=>'nullable|image|mimes:jpg,png,jpeg,gif',
            'position'=>'required|numeric',
            'status'=>'required|numeric|in:1,0',
        ];
    }
}
