<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\ProfileCompleteRequest;
use App\Models\Market\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
    }

    public function update()
    {

    }

    public function complete()
    {
        $user=Auth::user();
        $cartItems=CartItem::where('user_id',$user->id)->get();
        return view('app.profile.complete',compact('user','cartItems'));
    }

    public function updateComplete(ProfileCompleteRequest $request)
    {
        $user=Auth::user();
        $nationalCode = trim($request->national_code, ' .');
        $nationalCode = convertArabicToEnglish($nationalCode);
        $nationalCode = convertPersianToEnglish($nationalCode);
        $user->update([
            'mobile' =>$request->mobile ?? $user->mobile,
            'email' =>$request->email ?? $user->email,
            'first_name' =>$request->first_name ?? $user->first_name,
            'last_name' =>$request->last_name ?? $user->last_name,
            'national_code' =>$nationalCode ?? $user->national_code
        ]);
        return redirect()->route('market.address-and-delivery');
    }




}
