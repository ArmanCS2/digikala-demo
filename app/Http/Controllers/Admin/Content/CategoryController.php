<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Http\Services\Image\ImageCacheService;
use App\Http\Services\Image\ImageService;
use App\Models\Content\PostCategory;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function __construct()
    {
        //$this->middleware('can:show-category')->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*if(Auth::user()->cannot('show-category')){
            return redirect()->back()->with('toast-error','دسترسی غیرمجاز');
        }*/
        $postCategories = PostCategory::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.content.category.index', compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if(Auth::user()->cannot('create-category')){
            return redirect()->back()->with('toast-error','دسترسی غیرمجاز');
        }*/
        $categories = PostCategory::all();
        return view('admin.content.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request, ImageService $imageService)
    {
        /*if(Auth::user()->cannot('create-category')){
            return redirect()->back()->with('toast-error','دسترسی غیرمجاز');
        }*/
        $inputs = $request->all();
        if ($request->hasFile('image')){
            /*$img = new ImageCacheService();
            return $img->cache('1.png');*/
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-categories');
            $result=$imageService->createIndexAndSave($request->file('image'));
            if (!$result){
                return redirect()->route('admin.content.category.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image']=$result;
        }

        PostCategory::create($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success', 'دسته بندی با موفقیت ساخته شد');
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
        /*if(Auth::user()->cannot('update-category')){
            return redirect()->back()->with('toast-error','دسترسی غیرمجاز');
        }*/
        $categories = PostCategory::all();
        $category = PostCategory::find($id);
        return view('admin.content.category.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCategoryRequest $request, $id, ImageService $imageService)
    {
        /*if(Auth::user()->cannot('update-category')){
            return redirect()->back()->with('toast-error','دسترسی غیرمجاز');
        }*/
        $postCategory=PostCategory::find($id);
        $inputs = $request->all();
        if ($request->hasFile('image')){
            if (!empty($postCategory->image)){
                $imageService->deleteIndex($postCategory->image);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-categories');
            $result=$imageService->createIndexAndSave($request->file('image'));
            if (!$result){
                return redirect()->route('admin.content.category.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image']=$result;
        }else{

            if (isset($inputs['currentImage']) && !empty($postCategory->image)){

                $image=$postCategory->image;
                $image['currentImage']=$inputs['currentImage'];
                $inputs['image']=$image;
            }
        }
        $postCategory->update($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success', 'دسته بندی با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*if(Auth::user()->cannot('delete-category')){
            return redirect()->back()->with('toast-error','دسترسی غیرمجاز');
        }*/
        $category = PostCategory::find($id);
        $category->delete();
        return redirect()->back()->with('swal-success', 'دسته بندی با موفقیت حذف شد');
    }

    public function changeStatus($id)
    {
        $category = PostCategory::find($id);
        $category->status == 1 ? $category->status = 0 : $category->status = 1;
        $category->save();
        return redirect()->back();
    }

    public function ajaxChangeStatus($id)
    {
        $category = PostCategory::find($id);
        $category->status == 1 ? $category->status = 0 : $category->status = 1;
        $result = $category->save();
        if ($result) {
            if ($category->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }

    public function getCategories()
    {
        $categories=PostCategory::all();
        return \response()->json($categories);
    }
}
