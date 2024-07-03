<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use App\Models\Market\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product=Product::find($id);
        $sizes=$product->sizes()->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.market.product.size.index',compact('product','sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product=Product::find($id);
        return view('admin.market.product.size.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $inputs=$request->all();
        $inputs['product_id']=$id;
        ProductSize::create($inputs);
        return redirect()->route('admin.market.product.size.index',[$id])->with('swal-success','سایز کالا با موفقیت ثبت شد');
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
        $size=ProductSize::find($id);
        return view('admin.market.product.size.edit',compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $size=ProductSize::find($id);
        $inputs=$request->all();
        $size->update($inputs);
        return redirect()->route('admin.market.product.size.index',[$size->product_id])->with('swal-success','سایز کالا با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size=ProductSize::find($id);
        $size->delete();
        return redirect()->route('admin.market.product.size.index',[$size->product_id])->with('swal-success','سایز کالا با موفقیت حذف شد');
    }
}
