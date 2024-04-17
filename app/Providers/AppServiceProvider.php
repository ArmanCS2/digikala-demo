<?php

namespace App\Providers;

use App\Models\Content\Comment;
use App\Models\Market\CartItem;
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

        view()->composer('app.layouts.header', function ($view) {
            $view->with('productCategories', ProductCategory::whereNull('parent_id')->where('status', 1)->where('show_in_menu', 1)->get());
            if (Auth::check()) {
                $view->with('cartItems', CartItem::where('user_id', Auth::user()->id)->get());
            } else {
                $view->with('cartItems', []);
            }
            $view->with('setting', Setting::first());
        });
    }
}
