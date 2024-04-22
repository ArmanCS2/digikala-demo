<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\GuaranteeRequest;
use App\Models\Market\Guarantee;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class GuaranteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product=Product::find($id);
        $guarantees=$product->guarantees()->orderBy('created_at','DESC')->paginate(20);
        return view('admin.market.product.guarantee.index',compact('product','guarantees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product=Product::find($id);
        return view('admin.market.product.guarantee.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuaranteeRequest $request,$id)
    {
        $inputs=$request->all();
        $inputs['product_id']=$id;
        Guarantee::create($inputs);
        return redirect()->route('admin.market.product.guarantee.index',[$id])->with('swal-success','گارانتی کالا با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guarantee=Guarantee::find($id);
        return view('admin.market.product.guarantee.edit',compact('guarantee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuaranteeRequest $request, $id)
    {
        $guarantee=Guarantee::find($id);
        $inputs=$request->all();
        $guarantee->update($inputs);
        return redirect()->route('admin.market.product.guarantee.index',[$guarantee->product_id])->with('swal-success','گارانتی کالا با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guarantee=Guarantee::find($id);
        $guarantee->delete();
        return redirect()->route('admin.market.product.guarantee.index',[$guarantee->product_id])->with('swal-success','گارانتی کالا با موفقیت حذف شد');
    }

    public function ajaxChangeStatus($id)
    {
        $guarantee = Guarantee::find($id);
        $guarantee->status == 1 ? $guarantee->status = 0 : $guarantee->status = 1;
        $result = $guarantee->save();
        if ($result) {
            if ($guarantee->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
