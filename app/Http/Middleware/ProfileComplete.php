<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('toast-info', 'برای تکمیل پروفایل ابتدا وارد حساب کاربری خود شوید');
        }
        $user = Auth::user();
        if (empty($user->first_name) || empty($user->last_name) || empty($user->mobile) || empty($user->national_code)) {
            return redirect()->route('profile.complete')->with('toast-info', 'ابتدا اطلاعات حساب کاربری خود را کامل کنید');
        }

        return $next($request);
    }
}
