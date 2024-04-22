<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'title'=>'required|min:2',
                'category_id'=>'required|regex:/^[0-9]+$/u|exists:post_categories,id',
                'summary'=>'nullable|min:5',
                'body'=>'required|min:5',
                'image'=>'required|image|mimes:jpg,png,jpeg,gif',
                'tags'=>'required|string',
                'status'=>'required|numeric|in:1,0',
                'published_at'=>'required|numeric'
            ];
        }
        return [
            'title'=>'required|max:100|min:2',
            'category_id'=>'required|regex:/^[0-9]+$/u|exists:post_categories,id',
            'summary'=>'required|min:5',
            'body'=>'required|max:1000|min:5',
            'image'=>'image|mimes:jpg,png,jpeg,gif',
            'tags'=>'required|string',
            'status'=>'required|numeric|in:1,0',
            'published_at'=>'required|numeric'
        ];
    }
}
