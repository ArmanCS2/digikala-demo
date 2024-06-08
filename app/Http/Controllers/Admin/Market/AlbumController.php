<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\StoreAlbumRequest;
use App\Http\Requests\Admin\Market\UpdateAlbumRequest;
use App\Http\Services\File\FileService;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Album;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::orderBy('ordering')->paginate(20);
        return view('admin.market.album.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.market.album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumRequest $request, ImageService $imageService, FileService $fileService)
    {
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'albums');
            $result = $imageService->save($request->file('image'));
            if (!$result) {
                return redirect()->route('admin.market.album.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $image = $result;
        }
        if ($request->hasFile('video')) {
            $fileService->setExclusiveDirectory('videos' . DIRECTORY_SEPARATOR . 'albums');
            $result = $fileService->moveToPublic($request->file('video'));
            if (!$result) {
                return redirect()->back()->with('swal-error', 'آپلود ویدیو با خطا مواجه شد');
            }
            $video = $result;
        }
        Album::create([
            'name' => $request->name,
            'type' => $request->type,
            'status' => $request->status,
            'ordering' => $request->ordering,
            'link' => $request->link,
            'image' => $image ?? null,
            'video' => $video ?? null
        ]);
        return redirect()->route('admin.market.album.index')->with('swal-success', 'آلبوم جدید با موفقیت ایجاد شد');

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
        $album = Album::find($id);
        return view('admin.market.album.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbumRequest $request, $id, ImageService $imageService, FileService $fileService)
    {
        $album = Album::find($id);
        if ($request->hasFile('image')) {
            $imageService->deleteImage($album->image);
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'albums');
            $result = $imageService->save($request->file('image'));
            if (!$result) {
                return redirect()->back()->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $album->update([
                'image' => $result
            ]);
        }
        if ($request->hasFile('video')) {
            $fileService->deleteFile($album->video);
            $fileService->setExclusiveDirectory('videos' . DIRECTORY_SEPARATOR . 'albums');
            $result = $fileService->moveToPublic($request->file('video'));
            if (!$result) {
                return redirect()->back()->with('swal-error', 'آپلود ویدیو با خطا مواجه شد');
            }
            $album->update([
                'video' => $result
            ]);
        }
        $album->update([
            'name' => $request->name ?? $album->name,
            'type' => $request->type ?? $album->type,
            'status' => $request->status ?? $album->status,
            'ordering' => $request->ordering ?? $album->ordering,
            'link' => $request->link ?? $album->link,
            'image' => $image ?? $album->image,
            'video' => $video ?? $album->video
        ]);
        return redirect()->route('admin.market.album.index')->with('swal-success', 'آلبوم با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, ImageService $imageService, FileService $fileService)
    {
        $album = Album::find($id);
        if (!empty($album->image)) {
            $imageService->deleteImage($album->image);
        }
        if (!empty($album->video)) {
            $fileService->deleteFile($album->video);
        }
        $album->delete();
        return redirect()->route('admin.market.album.index')->with('swal-success', 'آلبوم با موفقیت حذف شد');
    }


    public function ajaxChangeStatus($id)
    {
        $album = Album::find($id);
        $album->status == 1 ? $album->status = 0 : $album->status = 1;
        $result = $album->save();
        if ($result) {
            if ($album->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
