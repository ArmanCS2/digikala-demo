<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\ProfileCompleteRequest;
use App\Http\Requests\App\UpdateProfileRequest;
use App\Models\Market\CartItem;
use App\Models\Market\Product;
use App\Models\Market\ProductUser;
use App\Models\Market\ProvinceCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('app.profile.profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->update([
            'first_name' => $request->first_name ?? $user->first_name,
            'last_name' => $request->last_name ?? $user->last_name,
            'email' => $request->email ?? $user->email,
            'national_code' => $request->national_code ?? $user->national_code
        ]);
        return redirect()->back()->with('toast-success', 'اطلاعات حساب با موفقیت ویرایش شد');
    }

    public function complete()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->get();
        return view('app.profile.complete', compact('user', 'cartItems'));
    }

    public function updateComplete(ProfileCompleteRequest $request)
    {
        $user = Auth::user();
        $nationalCode = trim($request->national_code, ' .');
        $nationalCode = convertArabicToEnglish($nationalCode);
        $nationalCode = convertPersianToEnglish($nationalCode);
        $user->update([
            'mobile' => $request->mobile ?? $user->mobile,
            'email' => $request->email ?? $user->email,
            'first_name' => $request->first_name ?? $user->first_name,
            'last_name' => $request->last_name ?? $user->last_name,
            'national_code' => $nationalCode ?? $user->national_code
        ]);
        return redirect()->route('market.address-and-delivery');
    }

    public function orders(Request $request)
    {
        $user = Auth::user();
        if (isset($request->type)) {
            $orders = $user->orders()->where('order_status', $request->type)->get();
        } else {
            $orders = $user->orders;
        }

        return view('app.profile.orders', compact('orders'));
    }


    public function favorites()
    {
        $user = Auth::user();
        $products = $user->products;
        return view('app.profile.favorites', compact('products'));
    }


    public function deleteFromFavorites(Product $product)
    {
        $user = Auth::user();
        $favorite = ProductUser::where('product_id', $product->id)->where('user_id', $user->id)->first();
        $favorite->delete();
        return redirect()->back()->with('swal-success', 'محصول با موفقیت از لیست علاقه مندی ها حذف شد');
    }

    public function addresses()
    {
        $user=Auth::user();
        $addresses=$user->addresses;
        $provinces = ProvinceCity::where('parent', 0)->get();
        return view('app.profile.addresses',compact('addresses','provinces'));
    }


}
