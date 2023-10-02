<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class RoleRequest extends FormRequest
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
        $currentRouteName=Route::current()->getName();
        if ($currentRouteName=='admin.user.role.store'){
            return [
                'name'=>'required|min:2|max:100',
                'description'=>'required|min:2|max:500',
                'status'=>'required|numeric|in:0,1',
                'permissions.*'=>'exists:permissions,id'
            ];
        }

        if ($currentRouteName=='admin.user.role.update'){
            return [
                'name'=>'required|min:2|max:100',
                'description'=>'required|min:2|max:500',
                'status'=>'required|numeric|in:0,1',
            ];
        }

        if ($currentRouteName=='admin.user.role.update.permission'){
            return [
                'permissions.*'=>'exists:permissions,id'
            ];
        }

    }

    public function attributes()
    {
        return [
            'name'=>'نام نقش',
            'description'=>'توضیحات نقش',
            'permissions.*'=>'دسترسی'
        ];
    }
}
