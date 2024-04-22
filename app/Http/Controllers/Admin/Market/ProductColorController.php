<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductColorRequest;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product=Product::find($id);
        $colors=$product->colors()->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.market.product.color.index',compact('product','colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product=Product::find($id);
        return view('admin.market.product.color.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductColorRequest $request,$id)
    {
        $inputs=$request->all();
        $inputs['product_id']=$id;
        ProductColor::create($inputs);
        return redirect()->route('admin.market.product.color.index',[$id])->with('swal-success','رنگ کالا با موفقیت ثبت شد');
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
        $color=ProductColor::find($id);
        return view('admin.market.product.color.edit',compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductColorRequest $request, $id)
    {
        $color=ProductColor::find($id);
        $inputs=$request->all();
        $color->update($inputs);
        return redirect()->route('admin.market.product.color.index',[$color->product_id])->with('swal-success','رنگ کالا با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color=ProductColor::find($id);
        $color->delete();
        return redirect()->route('admin.market.product.color.index',[$color->product_id])->with('swal-success','رنگ کالا با موفقیت حذف شد');
    }
}
