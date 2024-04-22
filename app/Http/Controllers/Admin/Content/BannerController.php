<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\BannerRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners=Banner::orderBy('created_at','ASC')->paginate(20);
        $positions=Banner::$positions;
        return view('admin.content.banner.index', compact('banners','positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions=Banner::$positions;
        return view('admin.content.banner.create',compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request,ImageService $imageService)
    {
        $inputs=$request->all();
        if ($request->hasFile('image')){
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banners');
            $result=$imageService->save($request->file('image'));
            if (!$result){
                return redirect()->route('admin.content.banner.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image']=$result;
        }
        Banner::create($inputs);
        return redirect()->route('admin.content.banner.index')->with('swal-success','بنر با موفقیت ایجاد شد');
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
        $banner=Banner::find($id);
        $positions=Banner::$positions;
        return view('admin.content.banner.edit',compact('banner','positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id,ImageService $imageService)
    {
        $banner=Banner::find($id);
        $inputs = $request->all();
        if ($request->hasFile('image')){
            if (!empty($banner->image)){
                $imageService->deleteImage($banner->image);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'banners');
            $result=$imageService->save($request->file('image'));
            if (!$result){
                return redirect()->route('admin.content.banner.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image']=$result;
        }else{

            if (isset($inputs['currentImage']) && !empty($banner->image)){

                $image=$banner->image;
                $image['currentImage']=$inputs['currentImage'];
                $inputs['image']=$image;
            }
        }
        $banner->update($inputs);
        return redirect()->route('admin.content.banner.index')->with('swal-success', 'بنر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner=Banner::find($id);
        $banner->delete();
        return redirect()->route('admin.content.banner.index')->with('swal-success', 'بنر با موفقیت حذف شد');
    }

    public function ajaxChangeStatus($id)
    {
        $banner = Banner::find($id);
        $banner->status == 1 ? $banner->status = 0 : $banner->status = 1;
        $result = $banner->save();
        if ($result) {
            if ($banner->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
