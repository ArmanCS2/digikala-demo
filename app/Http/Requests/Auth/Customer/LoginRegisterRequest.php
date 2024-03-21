<?php

namespace App\Http\Requests\Auth\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class LoginRegisterRequest extends FormRequest
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
        $currentRouteName = Route::currentRouteName();
        if ($currentRouteName == 'auth.customer.login-register') {
            if (is_numeric(request()->all()['id'])) {
                return [
                    'id' => 'required|digits:11',
                    'g-recaptcha-response' => 'recaptcha'
                ];
            }

            return [
                'id' => 'required|email',
                'g-recaptcha-response' => 'recaptcha'
            ];
        } elseif ($currentRouteName == 'auth.customer.login-confirm') {
            return [
                'otp' => 'required|numeric',
                'g-recaptcha-response' => 'recaptcha'
            ];
        }


    }

    public function attributes()
    {
        $currentRouteName = Route::currentRouteName();
        if ($currentRouteName == 'auth.customer.login-register') {
            if (is_numeric(request()->all()['id'])) {
                return [
                    'id' => 'شماره تلفن',
                    'g-recaptcha-response' => 'recaptcha'
                ];
            }

            return [
                'id' => 'پست الکترونیک',
                'g-recaptcha-response' => 'recaptcha'
            ];
        } elseif ($currentRouteName == 'auth.customer.login-confirm') {
            return [
                'otp' => 'کد تایید',
                'g-recaptcha-response' => 'recaptcha'
            ];
        }
    }
}
