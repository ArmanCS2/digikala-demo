<?php

namespace App\Http\Controllers\App\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use App\Models\Market\Copan;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment()
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('order_status', 0)->first();
        if (empty($order)) {
            return redirect()->back()->with('toast-info', 'شما سفارشی برای ثبت ندارید');
        }
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $productPrices = 0;
        $totalProductPrices = 0;
        foreach ($cartItems as $cartItem) {
            $productPrices += $cartItem->productPrice();
            $totalProductPrices += $cartItem->totalProductPrice();
        }


        return view('app.market.payment',compact('order','cartItems','totalProductPrices','productPrices'));
    }

    public function copanDiscount(Request $request)
    {
        $user = Auth::user();
        $copan = Copan::where('code', $request->copan)->where('start_date', '<=', now())->where('end_date', '>=', now())->first();
        if (!empty($copan)) {
            if (!empty($copan->user_id) && $copan->user_id != $user->id) {
                return redirect()->back()->with('toast-info', 'شما مجاز به استفاده از این کد تخفیف نیستید');
            }
            $order = Order::where('user_id', $user->id)->where('order_status', 0)->first();
            if (!empty($order)) {
                if ($copan->amount_type == 0) {
                    $copanDiscountAmount = $order->order_final_amount * ($copan->amount / 100);
                } else {
                    $copanDiscountAmount = $copan->amount;
                }
                if ($copanDiscountAmount > $copan->discount_ceiling) {
                    $copanDiscountAmount = $copan->discount_ceiling;
                }
                $order->order_final_amount= $order->order_final_amount - $copanDiscountAmount;
                $order->copan_id = $copan->id;
                $order->copan_object = $copan;
                $order->order_copan_discount_amount=$copanDiscountAmount;
                $order->order_total_products_discount_amount+=$copanDiscountAmount;
                $order->save();
                return redirect()->back()->with('toast-success', 'کد تخفیف با موفقیت اعمال شد');
            }
            return redirect()->back()->with('toast-info', 'شما سفارشی برای ثبت ندارید');
        }
        return redirect()->back()->with('toast-info', 'کد تخفیف معتبر نمیباشد');
    }
}
