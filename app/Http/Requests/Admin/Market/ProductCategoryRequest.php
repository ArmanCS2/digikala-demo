<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                'name'=>'required|max:100|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'parent_id'=>'nullable',
                'description'=>'required|max:500|min:5',
                'image'=>'required|image|mimes:jpg,png,jpeg,gif',
                'tags'=>'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
                'status'=>'required|numeric|in:1,0',
                'show_in_menu'=>'required|numeric|in:1,0',
            ];
        }
        return [
            'name'=>'required|max:100|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'parent_id'=>'nullable',
            'description'=>'required|max:500|min:5',
            'image'=>'image|mimes:jpg,png,jpeg,gif',
            'tags'=>'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'status'=>'required|numeric|in:1,0',
            'show_in_menu'=>'required|numeric|in:1,0',
        ];
    }
}
