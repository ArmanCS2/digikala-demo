<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\Market\ProductMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::simplePaginate(15);
        return view('admin.market.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=ProductCategory::all();
        $brands=Brand::all();
        return view('admin.market.product.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request,ImageService $imageService)
    {

        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'products');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result) {
                return redirect()->route('admin.market.product.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)substr($inputs['published_at'], 0, 10));
        DB::transaction(function ()use ($request,$inputs){
            $product=Product::create($inputs);
            $metas=array_combine($request->meta_key,$request->meta_value);
            foreach ($metas as $key => $value){
                ProductMeta::create([
                    'meta_key'=>$key,
                    'meta_value'=>$value,
                    'product_id'=>$product->id
                ]);
            }
        });

        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول جدید با موفقیت ساخته شد');
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
        $product=Product::find($id);
        $categories=ProductCategory::all();
        $brands=Brand::all();
        return view('admin.market.product.edit',compact('product','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id,ImageService $imageService)
    {
        $inputs = $request->all();
        $product=Product::find($id);
        if ($request->hasFile('image')) {
            if (!empty($product->image)){
                $imageService->deleteIndex($product->image);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'products');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result) {
                return redirect()->route('admin.content.post.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }else{

            if (isset($inputs['currentImage']) && !empty($product->image)){

                $image=$product->image;
                $image['currentImage']=$inputs['currentImage'];
                $inputs['image']=$image;
            }
        }
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)substr($inputs['published_at'], 0, 10));
        $product->update($inputs);
        $metas=$product->metas;
        foreach ($metas as $key => $meta){
            $meta->update([
                'meta_key'=>$request->meta_key[$key],
                'meta_value'=>$request->meta_value[$key],
            ]);
        }
        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
        return redirect()->route('admin.market.product.index')->with('swal-success', 'محصول با موفقیت حذف شد');
    }

    public function ajaxChangeStatus($id)
    {
        $product = Product::find($id);
        $product->status == 1 ? $product->status = 0 : $product->status = 1;
        $result = $product->save();
        if ($result) {
            if ($product->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }

    public function ajaxChangeMarketable($id)
    {
        $product = Product::find($id);
        $product->marketable == 1 ? $product->marketable = 0 : $product->marketable = 1;
        $result = $product->save();
        if ($result) {
            if ($product->marketable == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
