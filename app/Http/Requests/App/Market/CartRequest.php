<?php

namespace App\Http\Requests\App\Market;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'color'=>'exists:product_colors,id',
            'guarantee'=>'exists:guarantees,id',
            'number'=>'numeric|min:1|max:5',
        ];
    }
}
