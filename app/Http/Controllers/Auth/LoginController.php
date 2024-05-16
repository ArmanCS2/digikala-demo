<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function view()
    {
        return view('app.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!empty($user)) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('home')->with('swal-success', 'با موفقیت وارد حساب کاربری خود شدید');
            }
            return redirect()->back()->withErrors([
                'password' => 'رمز عبور اشتباه است'
            ]);
        }

        return redirect()->back()->withErrors([
            'email' => 'کاربری با این مشخصات یافت نشد'
        ]);
    }
}
