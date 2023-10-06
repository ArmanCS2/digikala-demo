<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\BrandRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::all();
        return view('admin.market.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.market.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        if ($request->hasFile('logo')){
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brands');
            $result=$imageService->createIndexAndSave($request->file('logo'));
            if (!$result){
                return redirect()->route('admin.market.brand.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['logo']=$result;
        }

        Brand::create($inputs);
        return redirect()->route('admin.market.brand.index')->with('swal-success', 'برند جدید با موفقیت ساخته شد');
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
        $brand=Brand::find($id);
        return view('admin.market.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id, ImageService $imageService)
    {
        $brand=Brand::find($id);
        $inputs = $request->all();
        if ($request->hasFile('logo')){
            if (!empty($brand->logo)){
                $imageService->deleteIndex($brand->logo);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brands');
            $result=$imageService->createIndexAndSave($request->file('logo'));
            if (!$result){
                return redirect()->route('admin.market.brand.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['logo']=$result;
        }else{

            if (isset($inputs['currentImage']) && !empty($brand->logo)){

                $image=$brand->logo;
                $image['currentImage']=$inputs['currentImage'];
                $inputs['logo']=$image;
            }
        }
        $brand->update($inputs);
        return redirect()->route('admin.market.brand.index')->with('swal-success', 'برند با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand=Brand::find($id);
        $brand->delete();
        return redirect()->route('admin.market.brand.index')->with('swal-success', 'برند با موفقیت حذف شد');
    }

    public function ajaxChangeStatus($id)
    {
        $brand = Brand::find($id);
        $brand->status == 1 ? $brand->status = 0 : $brand->status = 1;
        $result = $brand->save();
        if ($result) {
            if ($brand->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
