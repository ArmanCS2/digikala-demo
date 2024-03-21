<?php

namespace App\Http\Controllers\App\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Market\CommentRequest;
use App\Models\Content\Comment;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\Market\ProductUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function product(Product $product)
    {
        $product->view+=1;
        $product->save();
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
        if (Auth::check()) {
            if ($product->user->contains(Auth::user()->id)) {
                $productUser = ProductUser::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();
                $productUser->delete();
                return response()->json([
                    'status' => 2
                ]);
            } else {
                ProductUser::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $product->id
                ]);
                return response()->json([
                    'status' => 1
                ]);
            }
        } else {
            return response()->json([
                'status' => 3
            ]);
        }
    }

    public function products(Request $request)
    {
        switch ($request->sort) {
            case "1":
                $column = 'created_at';
                $direction = 'DESC';
                break;
            case "2":
                $column = 'rate';
                $direction = 'DESC';
                break;
            case "3":
                $column = 'price';
                $direction = 'DESC';
                break;
            case "4":
                $column = 'price';
                $direction = 'ASC';
                break;
            case "5":
                $column = 'view';
                $direction = 'DESC';
                break;
            case "6":
                $column = 'sold_number';
                $direction = 'DESC';
                break;
            default:
                $column = 'created_at';
                $direction = 'ASC';
                break;
        }
        if (!empty($request->search)) {
            $query = Product::where('name', 'LIKE', "%$request->search%")->orderBy($column, $direction);
        } else {
            $query = Product::orderBy($column, $direction);
        }
        if (!empty($request->min_price)) {
            $query->where('price', '>=', $request->min_price);
        }
        if (!empty($request->max_price)) {
            $query->where('price', '<=', $request->max_price);
        }
        if (!empty($request->brands)) {
            $query->whereIn('brand_id', $request->brands);
        }
        if (!empty($request->category)) {
            $query->where('category_id', $request->category);
        }
        $products = $query->paginate(15);
        $products->appends($request->query());

        $brands = Brand::where('status', 1)->get();
        $categories = ProductCategory::whereNull('parent_id')->where('status', 1)->get();
        return view('app.market.products', compact('products', 'brands', 'categories'));
    }

}
