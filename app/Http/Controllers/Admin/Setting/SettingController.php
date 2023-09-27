<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\FileService;
use App\Models\Setting\Setting;
use Database\Seeders\SettingSeeder;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting=Setting::first();
        if (empty($setting)){
            $default=new SettingSeeder();
            $default->run();
            $setting=Setting::first();
        }
        return view('admin.setting.index',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $setting=Setting::find($id);
        return view('admin.setting.edit',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, FileService $imageService)
    {
        $setting=Setting::find($id);
        $inputs=$request->all();
        if ($request->hasFile('logo')){
            if (!empty($setting->logo)){
                $imageService->deleteImage($setting->logo);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'logo');
            $imageService->setImageName('logo');
            $result=$imageService->save($request->file('logo'));
            if (!$result){
                return redirect()->route('admin.setting.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['logo']=$result;
        }

        if ($request->hasFile('icon')){
            if (!empty($setting->icon)){
                $imageService->deleteImage($setting->icon);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'icon');
            $imageService->setImageName('icon');
            $result=$imageService->save($request->file('icon'));
            if (!$result){
                return redirect()->route('admin.setting.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['icon']=$result;
        }
        if (empty($inputs['logo'])){
            unset($inputs['logo']);
        }

        if (empty($inputs['icon'])){
            unset($inputs['icon']);
        }

        $setting->update($inputs);
        return redirect()->route('admin.setting.index')->with('swal-success', 'تنظیمات با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
