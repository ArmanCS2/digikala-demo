<?php

namespace App\Http\Controllers\App\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Market\StoreAddressDeliveryRequest;
use App\Http\Requests\App\Market\StoreAddressRequest;
use App\Http\Requests\App\Market\UpdateAddressRequest;
use App\Models\Market\Address;
use App\Models\Market\CartItem;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Delivery;
use App\Models\Market\Order;
use App\Models\Market\Province;
use App\Models\Market\ProvinceCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function addressAndDelivery()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $addresses = $user->addresses;
        $provinces = ProvinceCity::where('parent', 0)->get();
        $deliveries = Delivery::where('status', 1)->get();
        return view('app.market.address-and-delivery', compact('cartItems', 'addresses', 'provinces', 'deliveries'));
    }

    public function addAddress(StoreAddressRequest $request)
    {
        $user = Auth::user();
        if ($request->receiver == 'on') {
            Address::create([
                'user_id' => $user->id,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'no' => $request->no,
                'unit' => $request->unit,
                'recipient_first_name' => $request->recipient_first_name,
                'recipient_last_name' => $request->recipient_last_name,
                'mobile' => $request->mobile,
            ]);
        } else {
            Address::create([
                'user_id' => $user->id,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'no' => $request->no,
                'unit' => $request->unit,
                'recipient_first_name' => $user->first_name,
                'recipient_last_name' => $user->last_name,
                'mobile' => $user->mobile,
            ]);
        }
        return redirect()->back();
    }

    public function editAddress(UpdateAddressRequest $request, Address $address)
    {
        $user = Auth::user();
        if ($request->receiver == 'on') {
            $address->update([
                'province_id' => $request->province_id ?? $address->province_id,
                'city_id' => $request->city_id ?? $address->city_id,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'no' => $request->no,
                'unit' => $request->unit,
                'recipient_first_name' => $request->recipient_first_name,
                'recipient_last_name' => $request->recipient_last_name,
                'mobile' => $request->mobile,
            ]);
        } else {
            $address->update([
                'province_id' => $request->province_id ?? $address->province_id,
                'city_id' => $request->city_id ?? $address->city_id,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'no' => $request->no,
                'unit' => $request->unit,
                'recipient_first_name' => $user->first_name,
                'recipient_last_name' => $user->last_name,
                'mobile' => $user->mobile,
            ]);
        }
        return redirect()->back();
    }

    public function getCities(ProvinceCity $province)
    {
        $cities = $province->cities()->get()->toArray();
        if (!empty($cities)) {
            return response()->json([
                'status' => true,
                'cities' => $cities
            ]);
        }

        return response()->json([
            'status' => false,
            'cities' => null
        ]);
    }

    public function storeAddressDelivery(StoreAddressDeliveryRequest $request)
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $productPrices = 0;
        $productDiscounts = 0;
        $finalProductDiscounts = 0;
        $totalProductPrices = 0;
        foreach ($cartItems as $cartItem) {
            $productPrices += $cartItem->productPrice();
            $productDiscounts += $cartItem->productDiscount();
            $finalProductDiscounts += $cartItem->finalProductDiscount();
            $totalProductPrices += $cartItem->totalProductPrice();
        }
        $commonDiscount = CommonDiscount::where('start_date', '<=', now())->where('end_date', '>=', now())->where('status', 1)->orderBy('created_at', 'desc')->first();
        if (!empty($commonDiscount)) {
            $commonDiscountTotalProductPrices = $totalProductPrices * ($commonDiscount->percentage / 100);
            if ($commonDiscountTotalProductPrices > $commonDiscount->discount_ceiling) {
                $commonDiscountTotalProductPrices = $commonDiscount->discount_ceiling;
            }
            if ($totalProductPrices >= $commonDiscount->minimal_order_amount) {
                $totalProductPrices = $totalProductPrices - $commonDiscountTotalProductPrices;
            }
        }
        Order::updateOrCreate([
            'user_id' => $user->id,
            'order_status' => 0
        ],
            [
                'address_id' => $request->address_id,
                'address_object' => Address::find($request->address_id),
                'delivery_id' => $request->delivery_id,
                'delivery_object' => Delivery::find($request->delivery_id),
                'delivery_amount' => Delivery::find($request->delivery_id)->amount,
                'order_final_amount' => $totalProductPrices,
                'order_discount_amount' => $finalProductDiscounts,
                'common_discount_id' => $commonDiscount->id ?? null,
                'common_discount_object' => $commonDiscount ?? null,
                'order_common_discount_amount' => $commonDiscountTotalProductPrices ?? 0,
                'order_total_products_discount_amount' =>$finalProductDiscounts + ($commonDiscountTotalProductPrices ?? 0),

            ]);
        return redirect()->route('market.payment');
    }
}
