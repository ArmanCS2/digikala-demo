<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CopanRequest extends FormRequest
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
            'code'=>'required|string',
            'type'=>'required|in:0,1',
            'amount_type'=>'required|in:0,1',
            'amount'=>['required',request()->amount_type == 0 ? 'max:100' : '','numeric'],
            'discount_ceiling'=>'required|numeric',
            'start_date'=>'required|numeric',
            'end_date'=>'required|numeric',
            'status'=>'required|in:0,1',
            'user_id'=>'required_if:type,==,1|numeric|exists:users,id'
        ];
    }
}
