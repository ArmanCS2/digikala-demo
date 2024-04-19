<?php

namespace App\Http\Middleware;

use App\Models\Market\CartItem;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductMarketable
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
            return redirect()->back()->with('toast-info', 'ابتدا وارد حساب کاربری خود شوید');
        }
        $user=Auth::user();
        $cartItems=CartItem::where('user_id',$user->id)->get();
        foreach ($cartItems as $cartItem){
            if ($cartItem->product->marketable_number <= 0){
                $cartItem->delete();
                return redirect()->back()->with('swal-error',"محصول " . $cartItem->product->name ." موجود در سبد خرید ناموجود میباشد و از سبد خرید شما حذف شد");
            }
        }
        return $next($request);
    }
}
