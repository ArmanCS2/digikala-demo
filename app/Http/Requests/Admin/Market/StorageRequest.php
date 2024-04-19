<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class StorageRequest extends FormRequest
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
        if ($this->isMethod('post')){
            return [
                'product_count'=>'required|numeric',
                'receiver'=>'nullable|string',
                'deliverer'=>'nullable|string',
                'description'=>'nullable|string',
            ];
        }
        return [
            'marketable_number'=>'nullable|numeric',
            'frozen_number'=>'nullable|numeric',
            'sold_number'=>'nullable|numeric',
        ];
    }
}
