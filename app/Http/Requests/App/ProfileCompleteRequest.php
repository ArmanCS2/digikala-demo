<?php

namespace App\Http\Requests\App;

use App\Rules\NationalCode;
use Illuminate\Foundation\Http\FormRequest;

class ProfileCompleteRequest extends FormRequest
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
            'first_name'=>'string',
            'last_name'=>'string',
            'mobile'=>'numeric|digits:11|unique:users,mobile',
            'email'=>'string|email|unique:users,email',
            'national_code'=>['numeric','digits:10','unique:users,national_code',new NationalCode()],
        ];
    }
}
