<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\SMSRequest;
use App\Models\Notify\SMS;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smses=SMS::orderBy('created_at','DESC')->paginate(20);
        return view('admin.notify.sms.index',compact('smses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notify.sms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SMSRequest $request)
    {
        $inputs=$request->all();
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)substr($inputs['published_at'], 0, 10));
        SMS::create($inputs);
        return redirect()->route('admin.notify.sms.index')->with('swal-success', 'پیامک جدید با موفقیت ساخته شد');
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
        $sms=SMS::find($id);
        return view('admin.notify.sms.edit',compact('sms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SMSRequest $request, $id)
    {
        $sms=SMS::find($id);
        $inputs=$request->all();
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)substr($inputs['published_at'], 0, 10));
        $sms->update($inputs);
        return redirect()->route('admin.notify.sms.index')->with('swal-success', 'پیامک با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sms=SMS::find($id);
        $sms->delete();
        return redirect()->route('admin.notify.sms.index')->with('swal-success', 'پیامک با موفقیت حذف شد');
    }

    public function ajaxChangeStatus($id)
    {
        $sms =SMS::find($id);
        $sms->status == 1 ? $sms->status = 0 : $sms->status = 1;
        $result = $sms->save();
        if ($result) {
            if ($sms->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
