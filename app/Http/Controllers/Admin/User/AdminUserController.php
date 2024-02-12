<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminUserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins=User::where('user_type',1)->get();
        return view('admin.user.admin-user.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.admin-user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request,ImageService $imageService)
    {
        $inputs=$request->all();
        if ($request->hasFile('profile_photo_path')){
            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'profile-photo');
            $result=$imageService->save($request->file('profile_photo_path'));
            if (!$result){
                return redirect()->route('admin.user.admin-user.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path']=$result;
        }
        $inputs['user_type']=1;
        $inputs['password']=Hash::make($inputs['password']);
        User::create($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success', 'ادمین جدید با موفقیت ساخته شد');
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
        $admin=User::find($id);
        return view('admin.user.admin-user.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, $id,ImageService $imageService)
    {
        $inputs=$request->all();
        $admin=User::find($id);
        if ($request->hasFile('profile_photo_path')){
            $imageService->deleteImage($admin->profile_photo_path);
            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'profile-photo');
            $result=$imageService->save($request->file('profile_photo_path'));
            if (!$result){
                return redirect()->route('admin.user.admin-user.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path']=$result;
        }
        if (isset($inputs['password']) && !empty($inputs['password'])){
            $inputs['password']=Hash::make($inputs['password']);
        }else{
            unset($inputs['password']);
        }
        $admin->update($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success', 'ادمین با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin=User::find($id);
        $admin->delete();
        return redirect()->route('admin.user.admin-user.index')->with('swal-success', 'ادمین با موفقیت حذف شد');
    }


    public function ajaxChangeStatus($id)
    {
        $admin = User::find($id);
        $admin->status == 1 ? $admin->status = 0 : $admin->status = 1;
        $result = $admin->save();
        if ($result) {
            if ($admin->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }

    public function ajaxChangeActivation($id)
    {
        $admin = User::find($id);
        $admin->activation == 1 ? $admin->activation = 0 : $admin->activation = 1;
        $result = $admin->save();
        if ($result) {
            if ($admin->activation == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }

    public function roles($id)
    {
        $admin=User::find($id);
        $roles=Role::all();
        return view('admin.user.admin-user.edit-roles',compact('admin','roles'));
    }

    public function rolesUpdate(Request $request,$id)
    {
        $inputs=$request->all();
        $admin=User::find($id);
        $inputs['roles']=$inputs['roles'] ?? [];
        $admin->roles()->sync($inputs['roles']);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success','نقش ها با موفقیت ویرایش شد');
    }


    public function permissions($id)
    {
        $admin=User::find($id);
        $permissions=Permission::all();
        return view('admin.user.admin-user.edit-permission',compact('admin','permissions'));
    }

    public function permissionsUpdate(Request $request, $id)
    {
        $inputs=$request->all();
        $admin=User::find($id);
        $inputs['permissions']=$inputs['permissions'] ?? [];
        $admin->permissions()->sync($inputs['permissions']);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success','دسترسی ها با موفقیت ویرایش شد');
    }
}
