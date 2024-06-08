<?php

namespace App\Http\Controllers\App\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Content\CommentRequest;
use App\Models\Content\Comment;
use App\Models\Content\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function post(Post $post)
    {
        return view('app.content.post', compact('post'));
    }

    public function posts()
    {
        $posts = Post::where('status', 1)->paginate(15);
        return view('app.content.posts', compact('posts'));
    }

    public function storeComment(CommentRequest $request, Post $post)
    {
        if (Auth::check()) {
            Comment::create([
                'body' => $request->body,
                'author_id' => Auth::user()->id,
                'commentable_id' => $post->id,
                'commentable_type' => Post::class
            ]);
            return redirect()->back()->with('toast-info', 'نظر شما با موفقیت ثبت شد و پس از بازبینی منتشر میشود');
        }
        return redirect()->back()->with('toast-error', 'برای ثبت نظر ابتدا باید وارد حساب کاربری خود شوید');

    }
}
