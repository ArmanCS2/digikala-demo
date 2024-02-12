<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.content.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postCategories = PostCategory::all();
        return view('admin.content.post.create', compact('postCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'posts');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result) {
                return redirect()->route('admin.content.post.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        $inputs['author_id'] = Auth::user()->id;
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)substr($inputs['published_at'], 0, 10));
        Post::create($inputs);
        return redirect()->route('admin.content.post.index')->with('swal-success', 'پست جدید با موفقیت ساخته شد');
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
        $post=Post::find($id);
        $postCategories = PostCategory::all();
        return view('admin.content.post.edit',compact('post','postCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, ImageService $imageService)
    {
        $inputs = $request->all();
        $post=Post::find($id);
        if ($request->hasFile('image')) {
            if (!empty($post->image)){
                $imageService->deleteIndex($post->image);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'posts');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if (!$result) {
                return redirect()->route('admin.content.post.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }else{

            if (isset($inputs['currentImage']) && !empty($post->image)){

                $image=$post->image;
                $image['currentImage']=$inputs['currentImage'];
                $inputs['image']=$image;
            }
        }
        $inputs['published_at'] = date('Y-m-d H:i:s', (int)substr($inputs['published_at'], 0, 10));
        $post->update($inputs);
        return redirect()->route('admin.content.post.index')->with('swal-success', 'پست با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function ajaxChangeStatus($id)
    {
        $post = Post::find($id);
        $post->status == 1 ? $post->status = 0 : $post->status = 1;
        $result = $post->save();
        if ($result) {
            if ($post->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }

    public function ajaxChangeCommentable($id)
    {
        $post = Post::find($id);
        $post->commentable == 1 ? $post->commentable = 0 : $post->commentable = 1;
        $result = $post->save();
        if ($result) {
            if ($post->commentable == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
