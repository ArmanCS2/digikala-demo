<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\VideoRequest;
use App\Models\Content\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::orderBy('ordering')->paginate(20);
        return view('admin.content.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        Video::create([
            'title' => $request->title,
            'link' => $request->link,
            'url' => $request->url,
            'ordering' => $request->ordering,
            'status' => $request->status
        ]);
        return redirect()->route('admin.content.video.index')->with('swal-success', 'ویدیو با موفقیت ایجاد شد');
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
        $video = Video::find($id);
        return view('admin.content.video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, $id)
    {
        $video = Video::find($id);
        $video->update([
            'title' => $request->title ?? $video->title,
            'link' => $request->link ?? $video->link,
            'url' => $request->url ?? $video->url,
            'ordering' => $request->ordering ?? $video->ordering,
            'status' => $request->status ?? $video->ordering
        ]);
        return redirect()->route('admin.content.video.index')->with('swal-success', 'ویدیو با موفقیت ایجاد شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::find($id);
        $video->delete();
        return redirect()->route('admin.content.video.index')->with('swal-success', 'ویدیو با موفقیت حذف شد');
    }

    public function ajaxChangeStatus($id)
    {
        $video = Video::find($id);
        $video->status == 1 ? $video->status = 0 : $video->status = 1;
        $result = $video->save();
        if ($result) {
            if ($video->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
