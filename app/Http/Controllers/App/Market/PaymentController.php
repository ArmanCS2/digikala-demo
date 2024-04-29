<?php

namespace App\Http\Controllers\App\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Payment\PaymentService;
use App\Models\Market\CartItem;
use App\Models\Market\CashPayment;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Copan;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use App\Models\Market\OrderItem;
use App\Models\Market\Payment;
use App\Models\Setting\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $productPrices = 0;
        $productDiscounts = 0;
        $finalProductPrices = 0;
        $finalProductDiscounts = 0;
        $totalProductPrices = 0;
        foreach ($cartItems as $cartItem) {
            $productPrices += $cartItem->productPrice();
            $productDiscounts += $cartItem->productDiscount();
            $finalProductPrices += $cartItem->finalProductPrice();
            $finalProductDiscounts += $cartItem->finalProductDiscount();
            $totalProductPrices += $cartItem->totalProductPrice();
        }
        $order = Order::where('user_id', $user->id)->where('order_status', 0)->first();
        $commonDiscount = CommonDiscount::where('start_date', '<=', now())->where('end_date', '>=', now())->where('status', 1)->orderBy('created_at', 'desc')->first();
        $order->update([
            'final_price' => $finalProductPrices,
            'final_discount' => $finalProductDiscounts,
            'total_price' => $finalProductPrices - $finalProductDiscounts + $order->delivery_amount
        ]);

        if (!empty($commonDiscount)) {
            $commonDiscountAmount = $totalProductPrices * ($commonDiscount->percentage / 100);
            if ($commonDiscountAmount > $commonDiscount->discount_ceiling) {
                $commonDiscountAmount = $commonDiscount->discount_ceiling;
            }
            if ($totalProductPrices < $commonDiscount->minimal_order_amount) {
                $commonDiscount = null;
                $commonDiscountAmount = 0;
            }
            $order->update([
                'common_discount_id' => $commonDiscount->id ?? null,
                'common_discount_object' => $commonDiscount ?? null,
                'common_discount_amount' => $commonDiscountAmount ?? 0,
                'total_price' => $finalProductPrices - $finalProductDiscounts - ($commonDiscountAmount ?? 0) + $order->delivery_amount
            ]);
        }

        if (!empty($order->copan_id)) {
            $order->update([
                'common_discount_id' => null,
                'common_discount_object' => null,
                'common_discount_amount' => 0,
                'total_price' => $order->final_price - $order->copan_discount_amount + $order->delivery_amount,
            ]);
        }

        return view('app.market.payment', compact('order', 'cartItems', 'productPrices', 'productDiscounts', 'finalProductPrices', 'finalProductDiscounts', 'totalProductPrices'));
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
                    $copanDiscountAmount = $order->final_price * ($copan->amount / 100);
                } else {
                    $copanDiscountAmount = $copan->amount;
                }
                if ($copanDiscountAmount > $copan->discount_ceiling) {
                    $copanDiscountAmount = $copan->discount_ceiling;
                }

                if (empty($order->common_discount_id)) {
                    $order->update([
                        'copan_id' => $copan->id,
                        'copan_object' => $copan,
                        'copan_discount_amount' => $copanDiscountAmount,
                        'total_price' => $order->final_price - $copanDiscountAmount + $order->delivery_amount,
                    ]);
                } else {
                    $order->update([
                        'copan_id' => $copan->id,
                        'copan_object' => $copan,
                        'copan_discount_amount' => $copanDiscountAmount,
                        'common_discount_id' => null,
                        'common_discount_object' => null,
                        'common_discount_amount' => 0,
                        'total_price' => $order->final_price - $copanDiscountAmount + $order->delivery_amount,
                    ]);
                }

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
        $amount = $order->total_price;
        $setting = Setting::first();
        if ($setting->payment_status == 0) {
            return redirect()->back()->with('toast-error', 'درگاه پرداخت فعال نیست');
        }

        if ($request->payment_type == 1) {
            $targetModel = OnlinePayment::class;
            $type = 1;
            $paymentType = $targetModel::create([
                'amount' => $amount,
                'user_id' => $user->id,
                'gateway' => 'زرین پال',
                'pay_date' => now(),
                'status' => 1
            ]);
            $payment = Payment::create([
                'amount' => $amount,
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
                $paymentType->delete();
                $payment->delete();
                return redirect()->route('home')->with('toast-error', 'درگاه پرداخت فعال نیست');
            }

        } elseif ($request->payment_type == 2) {
            $targetModel = OfflinePayment::class;
            $type = 2;
            $paymentType = $targetModel::create([
                'amount' => $amount,
                'user_id' => $user->id,
                'pay_date' => now(),
                'status' => 1
            ]);
        } elseif ($request->payment_type == 3) {
            $targetModel = CashPayment::class;
            $type = 3;
            $paymentType = $targetModel::create([
                'amount' => $amount,
                'user_id' => $user->id,
                'pay_date' => now(),
                'cash_receiver' => $order->address->recipient_first_name . ' ' . $order->address->recipient_last_name,
                'status' => 1
            ]);
        } else {
            return redirect()->back()->with('toast-error', 'روش پرداخت نامعتبر است');
        }

        $payment = Payment::create([
            'amount' => $amount,
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
                $cartItem->product->marketable_number = $cartItem->product->marketable_number > 0 ? $cartItem->product->marketable_number - 1 : 0;
                $cartItem->product->sold_number = $cartItem->product->sold_number + 1;
                $cartItem->product->frozen_number = $cartItem->product->frozen_number > 0 ? $cartItem->product->frozen_number - 1 : 0;
                $cartItem->product->save();
                $cartItem->delete();
            }
            $order->update([
                'payment_status' => 1,
                'order_status' => 2
            ]);
            return redirect()->route('home')->with('swal-success', 'سفارش شما با موفقیت ثبت شد');
        }
        $order->delete();
        $onlinePayment->delete();
        return redirect()->route('home')->with('swal-error', 'پرداخت سفارش با خطا مواجه شد');
    }
}
