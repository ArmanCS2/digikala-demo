<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Http\Requests\Admin\Market\CommonDiscountRequest;
use App\Http\Requests\Admin\Market\CopanRequest;
use App\Models\Market\AmazingSale;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Copan;
use App\Models\Market\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function copanIndex()
    {
        $copans=Copan::all();
        return view('admin.market.discount.copan.index',compact('copans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function copanCreate()
    {
        $users=User::all();
        return view('admin.market.discount.copan.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function copanStore(CopanRequest $request)
    {
        $inputs = $request->all();
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)substr($inputs['start_date'], 0, 10));
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)substr($inputs['end_date'], 0, 10));
        if ($request->type==0){
            $inputs['user_id']=null;
        }
        Copan::create($inputs);
        return redirect()->route('admin.market.discount.copan.index')->with('swal-success', 'کوپبن تخفیف با موفقیت ایجاد شد');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function copanEdit($id)
    {
        $users=User::all();
        $copan=Copan::find($id);
        return view('admin.market.discount.copan.edit',compact('copan','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function copanUpdate(CopanRequest $request, $id)
    {
        $copan=Copan::find($id);
        $inputs = $request->all();
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)substr($inputs['start_date'], 0, 10));
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)substr($inputs['end_date'], 0, 10));
        if ($request->type==0){
            $inputs['user_id']=null;
        }
        $copan->update($inputs);
        return redirect()->route('admin.market.discount.copan.index')->with('swal-success', 'کوپبن تخفیف با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function copanDestroy($id)
    {
        $copan=Copan::find($id);
        $copan->delete();
        return redirect()->route('admin.market.discount.copan.index')->with('swal-success', 'کوپبن تخفیف با موفقیت حذف شد');
    }

    public function ajaxChangeCopanStatus($id)
    {
        $copan = Copan::find($id);
        $copan->status == 1 ? $copan->status = 0 : $copan->status = 1;
        $result = $copan->save();
        if ($result) {
            if ($copan->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function commonDiscountIndex()
    {
        $commonDiscounts = CommonDiscount::all();
        return view('admin.market.discount.common-discount.index', compact('commonDiscounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function commonDiscountCreate()
    {
        return view('admin.market.discount.common-discount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function commonDiscountStore(CommonDiscountRequest $request)
    {
        $inputs = $request->all();
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)substr($inputs['start_date'], 0, 10));
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)substr($inputs['end_date'], 0, 10));
        CommonDiscount::create($inputs);
        return redirect()->route('admin.market.discount.common-discount.index')->with('swal-success', 'تخفیف عمومی با موفقیت ایجاد شد');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function commonDiscountEdit($id)
    {
        $commonDiscount=CommonDiscount::find($id);
        return view('admin.market.discount.common-discount.edit',compact('commonDiscount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function commonDiscountUpdate(CommonDiscountRequest $request, $id)
    {
        $commonDiscount=CommonDiscount::find($id);
        $inputs = $request->all();
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)substr($inputs['start_date'], 0, 10));
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)substr($inputs['end_date'], 0, 10));
        $commonDiscount->update($inputs);
        return redirect()->route('admin.market.discount.common-discount.index')->with('swal-success', 'تخفیف عمومی با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function commonDiscountDestroy($id)
    {
        $commonDiscount=CommonDiscount::find($id);
        $commonDiscount->delete();
        return redirect()->route('admin.market.discount.common-discount.index')->with('swal-success', 'تخفیف عمومی با موفقیت حذف شد');
    }

    public function ajaxChangeCommonDiscountStatus($id)
    {
        $commonDiscount = CommonDiscount::find($id);
        $commonDiscount->status == 1 ? $commonDiscount->status = 0 : $commonDiscount->status = 1;
        $result = $commonDiscount->save();
        if ($result) {
            if ($commonDiscount->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function amazingSaleIndex()
    {
        $amazingSales=AmazingSale::all();
        return view('admin.market.discount.amazing-sale.index',compact('amazingSales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function amazingSaleCreate()
    {
        $products=Product::all();
        return view('admin.market.discount.amazing-sale.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function amazingSaleStore(AmazingSaleRequest $request)
    {
        $inputs = $request->all();
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)substr($inputs['start_date'], 0, 10));
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)substr($inputs['end_date'], 0, 10));
        AmazingSale::create($inputs);
        return redirect()->route('admin.market.discount.amazing-sale.index')->with('swal-success', 'تخفیف شگفت انگیز با موفقیت ایجاد شد');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function amazingSaleEdit($id)
    {
        $products=Product::all();
        $amazingSale=AmazingSale::find($id);
        return view('admin.market.discount.amazing-sale.edit',compact('products','amazingSale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function amazingSaleUpdate(AmazingSaleRequest $request, $id)
    {
        $amazingSale=AmazingSale::find($id);
        $inputs = $request->all();
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)substr($inputs['start_date'], 0, 10));
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)substr($inputs['end_date'], 0, 10));
        $amazingSale->update($inputs);
        return redirect()->route('admin.market.discount.amazing-sale.index')->with('swal-success', 'تخفیف شگفت انگیز با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function amazingSaleDestroy($id)
    {
        $amazingSale=AmazingSale::find($id);
        $amazingSale->delete();
        return redirect()->route('admin.market.discount.amazing-sale.index')->with('swal-success', 'تخفیف عمومی با موفقیت حذف شد');
    }

    public function ajaxChangeAmazingSaleStatus($id)
    {
        $amazingSale = AmazingSale::find($id);
        $amazingSale->status == 1 ? $amazingSale->status = 0 : $amazingSale->status = 1;
        $result = $amazingSale->save();
        if ($result) {
            if ($amazingSale->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
