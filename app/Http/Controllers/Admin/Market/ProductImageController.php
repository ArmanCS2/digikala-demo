<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductImageRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Product;
use App\Models\Market\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product = Product::find($id);
        return view('admin.market.product.image.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product = Product::find($id);
        return view('admin.market.product.image.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductImageRequest $request, $id, ImageService $imageService)
    {
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-images');
            $result = $imageService->save($request->file('image'));
            if (!$result) {
                return redirect()->route('admin.market.product.image.index', [$id])->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        $inputs['product_id'] = $id;
        ProductImage::create($inputs);
        return redirect()->route('admin.market.product.image.index', [$id])->with('swal-success', 'تصویر کالا با موفقیت ثبت شد');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = ProductImage::find($id);
        if (file_exists($image->image)) {
            unlink($image->image);
        }
        $image->delete();
        return redirect()->route('admin.market.product.image.index', [$image->product_id])->with('swal-success', 'تصویر کالا با موفقیت حذف شد');
    }
}
