<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryAttributeRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class CategoryAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes=CategoryAttribute::orderBy('created_at','DESC')->paginate(20);
        return view('admin.market.category.attribute.index',compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=ProductCategory::all();
        return view('admin.market.category.attribute.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryAttributeRequest $request)
    {
        $inputs=$request->all();
        CategoryAttribute::create($inputs);
        return redirect()->route('admin.market.category.attribute.index')->with('swal-success', 'فرم کالا با موفقیت ثبت شد');
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
        $attribute=CategoryAttribute::find($id);
        $categories=ProductCategory::all();
        return view('admin.market.category.attribute.edit',compact('attribute','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryAttributeRequest $request, $id)
    {
        $attribute=CategoryAttribute::find($id);
        $inputs=$request->all();
        $attribute->update($inputs);
        return redirect()->route('admin.market.category.attribute.index')->with('swal-success', 'فرم کالا با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute=CategoryAttribute::find($id);
        $attribute->delete();
        return redirect()->route('admin.market.category.attribute.index')->with('swal-success', 'فرم کالا با موفقیت حذف شد');
    }
}
