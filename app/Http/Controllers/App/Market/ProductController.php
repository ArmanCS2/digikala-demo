<?php

namespace App\Http\Controllers\App\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Market\CommentRequest;
use App\Models\Content\Comment;
use App\Models\Market\Product;
use App\Models\Market\ProductUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function product(Product $product)
    {
        $relatedProducts = Product::inRandomOrder()->take(10)->get();
        return view('app.market.product', compact('product', 'relatedProducts'));
    }


    public function storeComment(CommentRequest $request, Product $product)
    {
        Comment::create([
            'body' => $request->body,
            'author_id' => Auth::user()->id,
            'commentable_id' => $product->id,
            'commentable_type' => Product::class
        ]);
        return redirect()->back()->with('toast-info', 'نظر شما با موفقیت ثبت شد و پس از بازبینی منتشر میشود');
    }

    public function isFavorite(Product $product)
    {
        if (Auth::check()){
            if ($product->user->contains(Auth::user()->id)){
                $productUser = ProductUser::where('user_id', Auth::user()->id)->where('product_id',$product->id)->first();
                $productUser->delete();
                return response()->json([
                    'status'=>2
                ]);
            }else{
                ProductUser::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $product->id
                ]);
                return response()->json([
                    'status'=>1
                ]);
            }
        }else{
            return response()->json([
                'status'=>3
            ]);
        }
    }

}
