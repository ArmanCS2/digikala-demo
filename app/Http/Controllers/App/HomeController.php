<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Content\Page;
use App\Models\Content\Post;
use App\Models\Market\Album;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Sitemap\SitemapGenerator;

class HomeController extends Controller
{
    public function index()
    {
        $albums = Album::where('status', 1)->get();
        $posts = Post::where('status', 1)->get();
        $slideShows = Banner::where('position', 0)->where('status', 1)->get();
        $topBanners = Banner::where('position', 1)->where('status', 1)->take(2)->get();
        $middleBanners = Banner::where('position', 2)->where('status', 1)->take(2)->get();
        $bottomBanner = Banner::where('position', 3)->where('status', 1)->first();
        $ads = Banner::where('position', 4)->where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        $mostViewedProducts = Product::orderBy('view', 'DESC')->where('marketable_number', '>', 0)->where('status', 1)->take(15)->get();
        $offerProducts = Product::inRandomOrder()->where('marketable_number', '>', 0)->where('status', 1)->take(15)->get();
        $bestSalesProducts = Product::orderBy('marketable_number', 'DESC')->where('marketable_number', '>', 0)->where('status', 1)->take(15)->get();
        $newProducts = Product::orderBy('created_at', 'DESC')->where('marketable_number', '>', 0)->where('status', 1)->take(15)->get();
        /*set_time_limit(300);
        $path = public_path('sitemap.xml');
        SitemapGenerator::create('https://www.butikala.ir')->writeToFile($path);*/
        return view('app.index', compact('slideShows', 'topBanners', 'middleBanners', 'bottomBanner', 'brands', 'mostViewedProducts', 'offerProducts', 'ads', 'bestSalesProducts', 'posts', 'newProducts', 'albums'));
    }

    public function download($file_path)
    {
        if (file_exists(public_path($file_path))) {
            return response()->download(public_path($file_path));
        }
        return redirect()->back()->with('toast-error', 'فایلی وجود ندارد');
    }

    public function ckeditorUpload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $path = str_replace('/', DIRECTORY_SEPARATOR, public_path('images/ckeditor-images'));
            $fileName = $request->file('upload')->move($path, $fileName)->getFilename();

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/ckeditor-images/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
        return false;
    }

    public function page($title)
    {
        $page = Page::where('title', $title)->first();
        if (empty($page)) {
            abort(404);
        }
        return view('app.page', compact('page'));
    }
}
