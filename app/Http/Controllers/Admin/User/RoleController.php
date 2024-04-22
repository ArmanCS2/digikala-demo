<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\RoleRequest;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::orderBy('created_at','DESC')->paginate(20);
        return view('admin.user.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions=Permission::all();
        return view('admin.user.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $inputs=$request->all();
        $role=Role::create($inputs);
        $inputs['permissions']=$inputs['permissions'] ?? [];
        $role->permissions()->sync($inputs['permissions']);
        return redirect()->route('admin.user.role.index')->with('swal-success','نقش جدید با موفقیت ثبت شد');
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
        $role=Role::find($id);
        return view('admin.user.role.edit',compact('role'));
    }

    public function editPermission($id)
    {
        $role=Role::find($id);
        $permissions=Permission::all();
        return view('admin.user.role.edit-permission',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $inputs=$request->all();
        $role=Role::find($id);
        $role->update($inputs);
        return redirect()->route('admin.user.role.index')->with('swal-success','نقش با موفقیت ویرایش شد');

    }

    public function updatePermission(RoleRequest $request, $id)
    {
        $inputs=$request->all();
        $role=Role::find($id);
        $inputs['permissions']=$inputs['permissions'] ?? [];
        $role->permissions()->sync($inputs['permissions']);
        return redirect()->route('admin.user.role.index')->with('swal-success','دسترسی نقش با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role=Role::find($id);
        $role->delete();
        return redirect()->route('admin.user.role.index')->with('swal-success','نقش با موفقیت حذف شد');
    }

    public function ajaxChangeStatus($id)
    {
        $role = Role::find($id);
        $role->status == 1 ? $role->status = 0 : $role->status = 1;
        $result = $role->save();
        if ($result) {
            if ($role->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
