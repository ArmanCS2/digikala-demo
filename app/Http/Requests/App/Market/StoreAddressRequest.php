<?php

namespace App\Http\Requests\App\Market;

use App\Rules\PostalCode;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
            'province_id'=>'required|exists:province_cities,id',
            'city_id'=>'required|exists:province_cities,id',
            'postal_code'=>['required',new PostalCode()],
            'address'=>'required|string',
            'no'=>'required|string',
            'unit'=>'required|string',
            'receiver'=>'nullable',
            'recipient_first_name'=>'required_if:receiver,on|string',
            'recipient_last_name'=>'required_if:receiver,on|string',
            'mobile'=>'required_if:receiver,on|numeric|digits:11',
        ];
    }
}
