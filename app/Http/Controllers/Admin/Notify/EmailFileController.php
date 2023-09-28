<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Services\File\FileService;
use App\Http\Services\Image\ImageService;
use App\Models\Notify\Email;
use App\Models\Notify\EmailFile;
use Illuminate\Http\Request;

class EmailFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Email $email)
    {
        return view('admin.notify.email.file.index',compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Email $email)
    {
        return view('admin.notify.email.file.create',compact('email'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Email $email, FileService $fileService)
    {
        $inputs=$request->all();
        if ($request->hasFile('file')){
            $fileService->setExclusiveDirectory('files');
            $result=$fileService->moveToPublic($request->file('file'));
            if (!$result){
                return redirect()->route('admin.notify.email-file.index',[$email->id])->with('swal-error', 'آپلود فایل با خطا مواجه شد');
            }
            $inputs['public_mail_id']=$email->id;
            $inputs['file_path']=$result;
            $inputs['file_type']=$fileService->getFileFormat();
            $inputs['file_size']=$fileService->getFileSize();
            EmailFile::create($inputs);
            return redirect()->route('admin.notify.email-file.index',[$email->id])->with('swal-success', 'فایل با موفقیت آپلود شد');

        }
        return redirect()->route('admin.notify.email-file.index',[$email->id])->with('swal-error', 'آپلود فایل با خطا مواجه شد');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function ajaxChangeStatus($id)
    {
        $file = EmailFile::find($id);
        $file->status == 1 ? $file->status = 0 : $file->status = 1;
        $result = $file->save();
        if ($result) {
            if ($file->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
