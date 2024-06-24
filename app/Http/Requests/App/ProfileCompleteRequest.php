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
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'mobile' => 'nullable|numeric|digits:11',
            'email' => 'nullable|string|email',
            'national_code' => ['nullable', 'numeric', 'digits:10', 'unique:users,national_code', new NationalCode()],
        ];
    }
}
