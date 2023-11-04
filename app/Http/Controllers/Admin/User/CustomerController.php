<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CustomerRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use App\Notifications\NewCustomerRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=User::where('user_type',0)->get();
        return view('admin.user.customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request,ImageService $imageService)
    {
        $inputs=$request->all();
        if ($request->hasFile('profile_photo_path')){
            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'profile-photo');
            $result=$imageService->save($request->file('profile_photo_path'));
            if (!$result){
                return redirect()->route('admin.user.customer.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path']=$result;
        }
        $inputs['user_type']=0;
        $inputs['password']=Hash::make($inputs['password']);
        User::create($inputs);
        $details=[
            'message'=>'مشتری جدید ایجاد شد'
        ];
        $admin=User::find(1);
        $admin->notify(new NewCustomerRegister($details));
        return redirect()->route('admin.user.customer.index')->with('swal-success', 'مشتری جدید با موفقیت ساخته شد');
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
        $customer=User::find($id);
        return view('admin.user.customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id,ImageService $imageService)
    {
        $inputs=$request->all();
        $customer=User::find($id);
        if ($request->hasFile('profile_photo_path')){
            $imageService->deleteImage($customer->profile_photo_path);
            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'profile-photo');
            $result=$imageService->save($request->file('profile_photo_path'));
            if (!$result){
                return redirect()->route('admin.user.customer.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path']=$result;
        }
        if (isset($inputs['password']) && !empty($inputs['password'])){
            $inputs['password']=Hash::make($inputs['password']);
        }else{
            unset($inputs['password']);
        }
        $customer->update($inputs);
        return redirect()->route('admin.user.customer.index')->with('swal-success', 'مشتری با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer=User::find($id);
        $customer->delete();
        return redirect()->route('admin.user.customer.index')->with('swal-success', ' مشتری با موفقیت حذف شد');
    }

    public function ajaxChangeStatus($id)
    {
        $customer = User::find($id);
        $customer->status == 1 ? $customer->status = 0 : $customer->status = 1;
        $result = $customer->save();
        if ($result) {
            if ($customer->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }

    public function ajaxChangeActivation($id)
    {
        $customer = User::find($id);
        $customer->activation == 1 ? $customer->activation = 0 : $customer->activation = 1;
        $result = $customer->save();
        if ($result) {
            if ($customer->activation == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
