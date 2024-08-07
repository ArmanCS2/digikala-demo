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
        $order = Order::where('user_id', $user->id)->where('order_status', 0)->first();
        if (!empty($order)) {
            if (!empty($order->payment)) {
                $order->payment->delete();
            }
            $order->delete();
        }
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
        $addresses = $user->addresses;
        $provinces = ProvinceCity::where('parent', 0)->get();
        $deliveries = Delivery::where('status', 1)->get();
        return view('app.market.address-and-delivery', compact('cartItems', 'addresses', 'provinces', 'deliveries', 'productPrices', 'productDiscounts', 'finalProductPrices', 'finalProductDiscounts', 'totalProductPrices'));
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
                'recipient_first_name' => $request->recipient_first_name ?? $user->first_name,
                'recipient_last_name' => $request->recipient_last_name ?? $user->last_name,
                'mobile' => $request->mobile ?? $user->mobile,
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
        return redirect()->back()->with('swal-success', 'آدرس با موفقیت ایجاد شد');
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
                'recipient_first_name' => $request->recipient_first_name ?? $user->first_name,
                'recipient_last_name' => $request->recipient_last_name ?? $user->last_name,
                'mobile' => $request->mobile ?? $user->mobile,
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
        return redirect()->back()->with('swal-success', 'آدرس با موفقیت ویرایش شد');
    }

    public function deleteAddress(Address $address)
    {
        $address->delete();
        return redirect()->back()->with('swal-success', 'آدرس با موفقیت حذف شد');
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
        $order = Order::where('user_id', $user->id)->where('order_status', 0)->first();
        if (!empty($order)) {
            $order->delete();
        }


        $order = Order::where('user_id', $user->id)->where('order_status', 0)->first();
        if (!empty($order)) {
            $order->delete();
        }
        Order::updateOrcreate([
            'user_id' => $user->id,
            'order_status' => 0,
        ],
            [
                'address_id' => $request->address_id,
                'address_object' => Address::find($request->address_id),
                'delivery_id' => $request->delivery_id,
                'delivery_object' => Delivery::find($request->delivery_id),
                'delivery_amount' => Delivery::find($request->delivery_id)->amount,
            ]);
        return redirect()->route('market.payment');
    }
}
