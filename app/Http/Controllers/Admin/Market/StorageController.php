<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\StorageRequest;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.market.storage.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addProduct($id)
    {
        $product = Product::find($id);
        return view('admin.market.storage.add-product', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorageRequest $request, $id)
    {
        $product = Product::find($id);
        if (!empty($request->sizes) && !empty($request->sizeIds)) {
            $idSizes = array_combine($request->sizeIds, $request->sizes);
            foreach ($idSizes as $id => $size) {
                $productSize = $product->sizes()->find($id);
                $productSize->update([
                    'marketable_number' => $productSize->marketable_number + $size
                ]);
                $product->marketable_number += $size;
            }
        }

        $product->marketable_number += $request->product_count;
        $product->save();
        //Log::info("receiver => $request->receiver , deliverer => $request->deliverer , product_count => $request->product_count ");
        return redirect()->route('admin.market.storage.index')->with('swal-success', 'موجودی با موفقیت افزایش یافت');
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
        $product = Product::find($id);
        return view('admin.market.storage.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorageRequest $request, $id)
    {
        $product = Product::find($id);
        $inputs = $request->all();
        $product->update($inputs);
        if (!empty($request->sizes) && !empty($request->sizeIds)) {
            $idSizes = array_combine($request->sizeIds, $request->sizes);
            foreach ($idSizes as $id => $size) {
                $product->sizes()->find($id)->update([
                    'marketable_number' => $size
                ]);
            }
        }
        return redirect()->route('admin.market.storage.index')->with('swal-success', 'موجودی با موفقیت اصلاح یافت');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
