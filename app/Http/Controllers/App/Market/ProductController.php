<?php

namespace App\Http\Controllers\App\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Market\CommentRequest;
use App\Models\Content\Comment;
use App\Models\Market\Brand;
use App\Models\Market\Compare;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\Market\ProductUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function product(Product $product)
    {
        $product->view += 1;
        $product->save();
        $category = $product->categories()->whereNull('parent_id')->where('status', 1)->inRandomOrder()->first();
        $relatedProducts = $category->products()->take(10)->get()->except($product->id);
        return view('app.market.product', compact('product', 'relatedProducts'));
    }

    public function rate(Request $request, Product $product)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->boughtProducts($product->id)->count() > 0) {
                $user->rate($product, $request->rating);
                return redirect()->back()->with('toast-success', 'امتیاز با موفقیت ثبت شد');
            }
            return redirect()->back()->with('toast-info', 'فقط برای کالا های خریداری شده میتوانید امتیاز ثبت کنید');
        }
        return redirect()->back()->with('toast-info', 'برای ثبت امتیاز وارد حساب کاربری خود شوید');
    }

    public function addToCompare(Product $product)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $compare = $user->compare;
            if (empty($compare)) {
                $compare = Compare::create([
                    'user_id' => $user->id
                ]);
            }
            $product->compares()->sync($compare);
            return redirect()->back()->with('toast-success', ' کالا با موفقیت به لیست مقایسه اضافه شد برای مقایسه ی کالا ها به بخش پروفایل کاربری > لیست مقایسه ها مراجعه کنید.');
        }
        return redirect()->back()->with('toast-info', 'برای مقایسه کالاها وارد حساب کاربری خود شوید');
    }

    public function removeFromCompare(Product $product)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $compare = $user->compare;
            if ($product->compares->contains($compare)) {
                $product->compares()->detach($compare);
            }
            return redirect()->back()->with('toast-success', 'کالا با موفقیت از لیست مقایسه حذف شد');
        }
        return redirect()->back()->with('toast-info', 'برای مقایسه کالاها وارد حساب کاربری خود شوید');
    }


    public function storeComment(CommentRequest $request, Product $product)
    {
        if (Auth::check()) {
            Comment::create([
                'body' => $request->body,
                'author_id' => Auth::user()->id,
                'commentable_id' => $product->id,
                'commentable_type' => Product::class
            ]);
            return redirect()->back()->with('toast-info', 'نظر شما با موفقیت ثبت شد و پس از بازبینی منتشر میشود');
        }

        return redirect()->back()->with('toast-error', 'برای ثبت نظر ابتدا باید وارد حساب کاربری خود شوید');
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
            $query = Product::with('categories')->where('name', 'LIKE', "%$request->search%")->orderBy($column, $direction);
        } else {
            $query = Product::with('categories')->orderBy($column, $direction);
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
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('product_category_id', $request->category);
            });
        }
        $products = $query->paginate(15);
        $products->appends($request->query());

        $brands = Brand::where('status', 1)->get();
        $categories = ProductCategory::whereNull('parent_id')->where('status', 1)->where('show_in_menu', 1)->get();
        return view('app.market.products', compact('products', 'brands', 'categories'));
    }

    public function amazingSales(Request $request)
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
        $query = Product::with('categories')->whereHas('activeAmazingSaleObj');
        if (!empty($request->search)) {
            $query = $query->where('name', 'LIKE', "%$request->search%")->orderBy($column, $direction);
        } else {
            $query = $query->orderBy($column, $direction);
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
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('product_category_id', $request->category);
            });
        }
        $products = $query->paginate(15);
        $products->appends($request->query());

        $brands = Brand::where('status', 1)->get();
        $categories = ProductCategory::whereNull('parent_id')->where('status', 1)->get();
        return view('app.market.amazing-sales', compact('products', 'brands', 'categories'));
    }

}
