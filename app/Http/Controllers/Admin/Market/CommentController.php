<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;
use App\Models\Content\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unSeenComments = Comment::where('commentable_type', 'App\Models\Market\Product')->where('seen', 0)->get();
        foreach ($unSeenComments as $unSeenComment) {
            $unSeenComment->seen = 1;
            $unSeenComment->save();
        }
        $comments = Comment::where('commentable_type', 'App\Models\Market\Product')->get();
        return view('admin.market.comment.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.market.comment.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        $comment->seen=1;
        $comment->save();
        return view('admin.market.comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.market.comment.edit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajaxChangeStatus($id)
    {
        $comment = Comment::find($id);
        $comment->status == 1 ? $comment->status = 0 : $comment->status = 1;
        $result = $comment->save();
        if ($result) {
            if ($comment->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }

    public function approved($id)
    {
        $comment = Comment::find($id);
        if ($comment->approved == 1) {
            $comment->approved = 0;
        } else {
            $comment->approved = 1;
        }
        $comment->save();
        return redirect()->route('admin.market.comment.index')->with('swal-success', 'وضعیت نظر با موفقیت تغییر یافت');
    }

    public function answer(CommentRequest $request, $id)
    {
        $inputs = $request->all();
        $comment = Comment::find($id);
        $inputs['author_id'] = 1;
        $inputs['parent_id'] = $comment->id;
        $inputs['commentable_id'] = $comment->commentable_id;
        $inputs['commentable_type'] = $comment->commentable_type;
        $inputs['approved'] = 1;
        $inputs['status'] = 1;
        Comment::create($inputs);
        return redirect()->route('admin.market.comment.index')->with('swal-success', 'پاسخ با موفقیت ثبت شد');
    }
}
