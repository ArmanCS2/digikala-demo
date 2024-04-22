<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryValue;
use Illuminate\Http\Request;

class CategoryValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $attribute = CategoryAttribute::find($id);
        $values=$attribute->values()->orderBy('created_at','DESC')->paginate(20);
        return view('admin.market.category.attribute.value.index', compact('attribute','values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $attribute = CategoryAttribute::find($id);
        return view('admin.market.category.attribute.value.create', compact('attribute'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $inputs['category_attribute_id'] = $id;
        CategoryValue::create($inputs);
        return redirect()->route('admin.market.category.attribute.value.index', [$id])->with('swal-success', 'مقدار جدید برای فرم کالا ثبت شد');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $value = CategoryValue::find($id);
        return view('admin.market.category.attribute.value.edit', compact('value'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $value = CategoryValue::find($id);
        $inputs = $request->all();
        $inputs['value'] = json_encode(['value' => $request->value, 'price_increase' => $request->price_increase]);
        $value->update($inputs);
        return redirect()->route('admin.market.category.attribute.value.index', [$value->attribute->id])->with('swal-success', 'مقدار برای فرم کالا ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = CategoryValue::find($id);
        $value->delete();
        return redirect()->route('admin.market.category.attribute.value.index', [$value->attribute->id])->with('swal-success', 'مقدار برای فرم کالا حذف شد');
    }
}
