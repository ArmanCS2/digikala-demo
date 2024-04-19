<?php

namespace App\Http\Controllers\App\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Payment\PaymentService;
use App\Models\Market\CartItem;
use App\Models\Market\CashPayment;
use App\Models\Market\Copan;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use App\Models\Market\OrderItem;
use App\Models\Market\Payment;
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


        return view('app.market.payment', compact('order', 'cartItems', 'totalProductPrices', 'productPrices'));
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
                $order->order_final_amount = $order->order_final_amount - $copanDiscountAmount;
                $order->copan_id = $copan->id;
                $order->copan_object = $copan;
                $order->order_copan_discount_amount = $copanDiscountAmount;
                $order->order_total_products_discount_amount += $copanDiscountAmount;
                $order->save();
                return redirect()->back()->with('toast-success', 'کد تخفیف با موفقیت اعمال شد');
            }
            return redirect()->back()->with('toast-info', 'شما سفارشی برای ثبت ندارید');
        }
        return redirect()->back()->with('toast-info', 'کد تخفیف معتبر نمیباشد');
    }

    public function paymentType(Request $request, PaymentService $paymentService)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('order_status', 0)->first();
        $cartItems = CartItem::where('user_id', $user->id)->get();

        if ($request->payment_type == 1) {
            $targetModel = OnlinePayment::class;
            $type = 0;
            $amount = $order->order_final_amount + $order->delivery_amount;
            $paymentType = $targetModel::create([
                'amount' => $amount,
                'user_id' => $user->id,
                'gateway' => 'زرین پال',
                'pay_date' => now(),
                'status' => 1
            ]);
            $payment = Payment::create([
                'amount' => $order->order_final_amount + $order->delivery_amount,
                'user_id' => $user->id,
                'status' => 1,
                'type' => $type,
                'paymentable_id' => $paymentType->id,
                'paymentable_type' => $targetModel
            ]);
            $order->update([
                'payment_id' => $payment->id,
                'payment_object' => $payment,
                'payment_type' => $type
            ]);
            $result = $paymentService->zarinPal($order, $amount, $paymentType);
            if ($result === false) {
                return redirect()->back()->with('toast-error', 'درگاه پرداخت فعال نیست');
            }

        } elseif ($request->payment_type == 2) {
            $targetModel = OfflinePayment::class;
            $type = 1;
            $paymentType = $targetModel::create([
                'amount' => $order->order_final_amount + $order->delivery_amount,
                'user_id' => $user->id,
                'pay_date' => now(),
                'status' => 1
            ]);
        } elseif ($request->payment_type == 3) {
            $targetModel = CashPayment::class;
            $type = 2;
            $paymentType = $targetModel::create([
                'amount' => $order->order_final_amount + $order->delivery_amount,
                'user_id' => $user->id,
                'pay_date' => now(),
                'cash_receiver' => $order->address->recipient_first_name . ' ' . $order->address->recipient_last_name,
                'status' => 1
            ]);
        } else {
            return redirect()->back()->with('toast-error', 'روش پرداخت نامعتبر است');
        }

        $payment = Payment::create([
            'amount' => $order->order_final_amount + $order->delivery_amount,
            'user_id' => $user->id,
            'status' => 1,
            'type' => $type,
            'paymentable_id' => $paymentType->id,
            'paymentable_type' => $targetModel
        ]);
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product' => $cartItem->product,
                'color_id' => $cartItem->color_id,
                'guarantee_id' => $cartItem->guarantee_id,
                'amazing_sale_id' => $cartItem->product->activeAmazingSale()->id ?? null,
                'amazing_sale_object' => $cartItem->product->activeAmazingSale() ?? null,
                'amazing_sale_discount_amount' => $cartItem->productDiscount(),
                'number' => $cartItem->number,
                'final_product_price' => $cartItem->finalProductPrice(),
                'final_total_price' => $cartItem->totalProductPrice()
            ]);
            $cartItem->product->marketable_number = $cartItem->product->marketable_number > 0 ? $cartItem->product->marketable_number - 1 : 0;
            $cartItem->product->sold_number = $cartItem->product->sold_number + 1;
            $cartItem->product->frozen_number = $cartItem->product->frozen_number > 0 ? $cartItem->product->frozen_number - 1 : 0;
            $cartItem->product->save();


            $cartItem->delete();
        }
        $order->update([
            'payment_id' => $payment->id,
            'payment_object' => $payment,
            'payment_type' => $type,
            'order_status' => 2
        ]);
        return redirect()->route('home')->with('swal-success', 'سفارش شما با موفقیت ثبت شد');
    }

    public function paymentCallback(Order $order, $amount, OnlinePayment $onlinePayment)
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $paymentService = new PaymentService();
        $result = $paymentService->zarinpalVerify($amount, $onlinePayment);
        if ($result['success']) {
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product' => $cartItem->product,
                    'color_id' => $cartItem->color_id,
                    'guarantee_id' => $cartItem->guarantee_id,
                    'amazing_sale_id' => $cartItem->product->activeAmazingSale()->id ?? null,
                    'amazing_sale_object' => $cartItem->product->activeAmazingSale() ?? null,
                    'amazing_sale_discount_amount' => $cartItem->productDiscount(),
                    'number' => $cartItem->number,
                    'final_product_price' => $cartItem->finalProductPrice(),
                    'final_total_price' => $cartItem->totalProductPrice()
                ]);
                $cartItem->delete();
            }
            $order->update([
                'payment_status' => 1,
                'order_status' => 2
            ]);
            return true;
        }
        return redirect()->route('home')->with('swal-error', 'پرداخت سفارش با خطا مواجه شد');
    }
}
