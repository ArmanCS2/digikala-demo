<?php

namespace App\Providers;

use App\Models\Content\Comment;
use App\Models\Content\Footer;
use App\Models\Content\Menu;
use App\Models\Market\CartItem;
use App\Models\Market\CommonDiscount;
use App\Models\Market\ProductCategory;
use App\Models\Notification;
use App\Models\Setting\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.layouts.header', function ($view) {
            $view->with('unSeenComments', Comment::where('seen', 0)->get());
            $view->with('notifications', Notification::where('read_at', null)->get());
        });

        view()->composer('app.*', function ($view) {
            $view->with('setting', Setting::first());
            $view->with('commonDiscount', CommonDiscount::where('start_date', '<=', now())->where('end_date', '>=', now())->where('status', 1)->orderBy('created_at', 'desc')->first());
        });

        view()->composer('app.layouts.header', function ($view) {
            $view->with('productCategories', ProductCategory::whereNull('parent_id')->where('status', 1)->where('show_in_menu', 1)->orderBy('order')->get());
            $view->with('cartItems', CartItem::where('user_id', Auth::user()->id ?? null)->orderBy('created_at')->get());
            $view->with('menus', Menu::where('status', 1)->orderBy('order')->get());
        });


        view()->composer('app.layouts.footer', function ($view) {
            $view->with('footers', Footer::orderBy('order')->get());
        });
    }
}
