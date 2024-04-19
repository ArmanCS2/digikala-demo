<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'name'=>'required|max:100|min:2',
                'category_id'=>'nullable|exists:product_categories,id',
                'brand_id'=>'nullable|exists:brands,id',
                'introduction'=>'required|min:5',
                'image'=>'required|image|mimes:jpg,png,jpeg,gif',
                'tags'=>'required|string',
                'status'=>'required|numeric|in:1,0',
                'marketable'=>'required|numeric|in:1,0',
                'published_at'=>'required|numeric',
                'weight'=>'nullable|numeric',
                'length'=>'nullable|numeric',
                'height'=>'nullable|numeric',
                'width'=>'nullable|numeric',
                'price'=>'required|numeric',
                'meta_key.*'=>'nullable|string',
                'meta_value.*'=>'nullable|string',

            ];
        }
        return [
            'name'=>'required|max:100|min:2',
            'category_id'=>'nullable|exists:product_categories,id',
            'brand_id'=>'nullable|exists:brands,id',
            'introduction'=>'required|min:5',
            'image'=>'image|mimes:jpg,png,jpeg,gif',
            'tags'=>'required|string',
            'status'=>'required|numeric|in:1,0',
            'marketable'=>'required|numeric|in:1,0',
            'published_at'=>'required|numeric',
            'weight'=>'nullable|numeric',
            'length'=>'nullable|numeric',
            'height'=>'nullable|numeric',
            'width'=>'nullable|numeric',
            'price'=>'required|numeric',
            'meta_key.*'=>'nullable|string',
            'meta_value.*'=>'nullable|string',
        ];
    }
}
