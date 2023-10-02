<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            'name'=>'required|string|min:1|max:100',
            'amount'=>'required|numeric',
            'delivery_time'=>'required|numeric',
            'delivery_time_unit'=>'required|string|min:1|max:100',
            'status'=>'required|numeric|in:0,1',
        ];
    }
}
