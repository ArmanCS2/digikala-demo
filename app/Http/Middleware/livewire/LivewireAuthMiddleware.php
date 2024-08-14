<?php

namespace App\Http\Middleware\livewire;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LivewireAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('livewire.auth.index')->with('error', 'ابتدا وارد حساب کاربری خود شوید');
        }
        return $next($request);
    }
}
