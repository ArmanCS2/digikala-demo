<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
                'original_name'=>'required|max:100|min:2',
                'persian_name'=>'required',
                'logo'=>'required|image|mimes:jpg,png,jpeg,gif',
                'tags'=>'required',
                'status'=>'required|numeric|in:1,0',
            ];
        }
        return [
            'original_name'=>'required|max:100|min:2',
            'persian_name'=>'required',
            'logo'=>'image|mimes:jpg,png,jpeg,gif',
            'tags'=>'required',
            'status'=>'required|numeric|in:1,0',
        ];
    }
}
