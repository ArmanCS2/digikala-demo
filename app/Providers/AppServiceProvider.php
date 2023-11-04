<?php

namespace App\Providers;

use App\Models\Content\Comment;
use App\Models\Market\ProductCategory;
use App\Models\Notification;
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
        view()->composer('admin.layouts.header',function ($view){
            $view->with('unSeenComments',Comment::where('seen',0)->get());
            $view->with('notifications',Notification::where('read_at',null)->get());
        });

        view()->composer(['app.index','app.market.product'],function ($view){
            $view->with('productCategories',ProductCategory::whereNull('parent_id')->where('status',1)->where('show_in_menu',1)->get());
        });
    }
}
