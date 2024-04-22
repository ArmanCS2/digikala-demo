<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\EmailRequest;
use App\Models\Notify\Email;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails=Email::orderBy('created_at','DESC')->paginate(20);
        return view('admin.notify.email.index',compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notify.email.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailRequest $request)
    {
        $inputs=$request->all();
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)substr($inputs['published_at'], 0, 10));
        Email::create($inputs);
        return redirect()->route('admin.notify.email.index')->with('swal-success', 'ایمیل جدید با موفقیت ساخته شد');
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
        $email=Email::find($id);
        return view('admin.notify.email.edit',compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailRequest $request, $id)
    {
        $email=Email::find($id);
        $inputs=$request->all();
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)substr($inputs['published_at'], 0, 10));
        $email->update($inputs);
        return redirect()->route('admin.notify.email.index')->with('swal-success', 'ایمیل با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $email=Email::find($id);
        $email->delete();
        return redirect()->route('admin.notify.email.index')->with('swal-success', 'ایمیل با موفقیت حذف شد');
    }

    public function ajaxChangeStatus($id)
    {
        $email =Email::find($id);
        $email->status == 1 ? $email->status = 0 : $email->status = 1;
        $result = $email->save();
        if ($result) {
            if ($email->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
