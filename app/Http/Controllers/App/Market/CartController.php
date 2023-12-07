<?php

namespace App\Http\Controllers\App\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Market\CartRequest;
use App\Models\Market\CartItem;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CartController extends Controller
{
    public function cart()
    {
        if (Auth::check()) {
            $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
            $relatedProducts = Product::inRandomOrder()->take(10)->get();
            return view('app.market.cart',compact('cartItems','relatedProducts'));
        }

        return redirect()->back()->with('toast-info', 'برای مشاهده سبد خرید باید وارد حساب کاربری خود شوید');

    }

    public function addProduct(CartRequest $request, Product $product)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cartItems = CartItem::where('user_id', $user->id)->where('product_id', $product->id)->get();
            foreach ($cartItems as $cartItem) {
                if ($cartItem->color_id == $request->color && $cartItem->guarantee_id == $request->guarantee) {
                    if ($cartItem->number != ($request->number ?? 1)) {
                        $cartItem->update([
                            'number' => $request->number ?? 1
                        ]);
                        return redirect()->back()->with('swal-success', 'تعداد محصول مورد نظر در سبد خرید با موفقیت ویرایش شد');
                    }
                    return redirect()->back()->with('toast-info', 'محصول در سبد خرید موجود میباشد');

                }
            }
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'color_id' => $request->color ?? null,
                'guarantee_id' => $request->guarantee ?? null,
                'number' => $request->number ?? 1
            ]);
            return redirect()->back()->with('swal-success', 'محصول با موفقیت به سبد خرید اضافه شد');
        }
        return redirect()->back()->with('toast-info', 'برای اضافه کردن به سبد خرید باید وارد حساب کاربری خود شوید');
    }

    public function removeProduct(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->back()->with('swal-success', 'محصول با موفقیت از سبد خرید حذف شد');
    }
}
