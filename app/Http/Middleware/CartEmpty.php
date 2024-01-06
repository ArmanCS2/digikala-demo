<?php

namespace App\Http\Middleware;

use App\Models\Market\CartItem;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartEmpty
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
        $user = Auth::user();
        if (empty(CartItem::where('user_id', $user->id)->count())) {
            return redirect()->route('home')->with('toast-info', 'سبد خرید خالی است');
        }
        return $next($request);
    }
}
