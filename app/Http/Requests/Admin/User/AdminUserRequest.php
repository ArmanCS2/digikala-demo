<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminUserRequest extends FormRequest
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
                'first_name'=>'required|min:1|max:100',
                'last_name'=>'required|min:1|max:100',
                'mobile'=>'required|digits:11|unique:users',
                'email'=>'required|email|unique:users',
                'password'=>['required',Password::min(8)->letters()->numbers()->mixedCase()->uncompromised()->symbols(),'confirmed'],
                'profile_photo_path'=>'nullable|image|mimes:jpeg,jpg,png,gif',
                'activation'=>'required|numeric|in:1,0',
            ];
        }

        return [
            'first_name'=>'required|min:1|max:100',
            'last_name'=>'required|min:1|max:100',
            'password'=>['nullable',Password::min(8)->letters()->numbers()->mixedCase()->uncompromised()->symbols(),'confirmed'],
            'profile_photo_path'=>'nullable|image|mimes:jpeg,jpg,png,gif',
            'activation'=>'required|numeric|in:1,0',
        ];

    }
}
