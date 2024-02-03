<?php

namespace App\Http\Requests\App;

use App\Rules\NationalCode;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'first_name'=>'nullable|string|max:100',
            'last_name'=>'nullable|string|max:100',
            'email'=>'nullable|email|unique:users,email',
            'national_code'=>['nullable','unique:users,national_code',new NationalCode()]
        ];
    }
}
