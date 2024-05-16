<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('home')->with('swal-success', 'با موفقیت از حساب کاربری خارج شدید');
    }
}
