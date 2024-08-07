<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
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
        //regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u
        //regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u
        if($this->isMethod('post')){
            return [
                'name'=>'required|max:100|min:2|string',
                'parent_id'=>'nullable',
                'description'=>'required|max:500|min:5',
                'image'=>'nullable|image|mimes:jpg,png,jpeg,gif',
                'tags'=>'required|string',
                'status'=>'required|numeric|in:1,0',
            ];
        }
        return [
            'name'=>'required|max:100|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'parent_id'=>'nullable',
            'description'=>'required|max:500|min:5',
            'image'=>'image|mimes:jpg,png,jpeg,gif',
            'tags'=>'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'status'=>'required|numeric|in:1,0',
        ];
    }
}
