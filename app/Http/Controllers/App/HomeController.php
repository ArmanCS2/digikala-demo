<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Content\Post;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Sitemap\SitemapGenerator;

class HomeController extends Controller
{
    public function index()
    {
        $posts=Post::where('status',1)->get();
        $slideShows=Banner::where('position',0)->where('status',1)->get();
        $topBanners=Banner::where('position',1)->where('status',1)->take(2)->get();
        $middleBanners=Banner::where('position',2)->where('status',1)->take(2)->get();
        $bottomBanner=Banner::where('position',3)->where('status',1)->first();
        $ads=Banner::where('position',4)->where('status',1)->get();
        $brands=Brand::where('status',1)->get();
        $mostViewedProducts=Product::inRandomOrder()->take(10)->get();
        $offerProducts=Product::inRandomOrder()->take(10)->get();
        $bestSalesProducts=Product::inRandomOrder()->take(10)->get();
        /*set_time_limit(300);
        $path = public_path('sitemap.xml');
        SitemapGenerator::create('https://butikala.ir')->writeToFile($path);*/
        return view('app.index',compact('slideShows','topBanners','middleBanners','bottomBanner','brands','mostViewedProducts','offerProducts','ads','bestSalesProducts','posts'));
    }

    public function download($file_path){
        if(file_exists(public_path($file_path))){
            return response()->download(public_path($file_path));
        }
        return redirect()->back()->with('toast-error', 'فایلی وجود ندارد');
    }
}
