<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function view($token)
    {
        $user = User::where('remember_token', $token)->first();
        if (empty($user)) {
            return redirect()->route('auth.login.form')->with('toast-error', 'لینک تغییر رمز عبور معتبر نیست');
        }
        if ($user->remember_token_expire < now()) {
            return redirect()->route('auth.login.form')->with('toast-error', 'لینک تغییر رمز عبور منقضی شده');
        }
        return view('app.auth.reset-password');
    }

    public function resetPassword(ResetPasswordRequest $request, $token)
    {
        $user = User::where('remember_token', $token)->first();
        if (empty($user)) {
            return redirect()->route('auth.login.form')->with('toast-error', 'لینک تغییر رمز عبور معتبر نیست');
        }
        if ($user->remember_token_expire < now()) {
            return redirect()->route('auth.login.form')->with('toast-error', 'لینک تغییر رمز عبور منقضی شده');
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('auth.login.form')->with('swal-success', 'رمز عبور با موفقیت تغییر یافت');
    }
}
