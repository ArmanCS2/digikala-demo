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
            'province_id' => 'required|exists:province_cities,id',
            'city_id' => 'required|exists:province_cities,id',
            'postal_code' => ['required', 'numeric'],
            'address' => 'required|string',
            'no' => 'nullable|string',
            'unit' => 'nullable|string',
            'receiver' => 'nullable',
            'recipient_first_name' => 'nullable|string',
            'recipient_last_name' => 'nullable|string',
            'mobile' => 'nullable|numeric|digits:11',
        ];
    }
}
