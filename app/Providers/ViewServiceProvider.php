<?php
 
namespace App\Providers;
 
// use App\View\Composers\ProfileComposer;s
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Home\MenuController as Menu;
 
class ViewServiceProvider extends ServiceProvider
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
        // Using class based composers...
        // View::composer('profile', ProfileComposer::class);
 
        
        // Using closure based composers...
        View::composer('home.header', function ($view) {
            $config = DB::table('configs')->find(1);//dd($config);
             $view->with('header_address', $config->content_home_1);
             $view->with('header_phone', $config->content_home_7);
             $view->with('header_logo', $config->logo);

             $menu = new Menu;
             $view->with('header_menu', $menu->header_menu());
        });

        View::composer('home.footer', function ($view) {
            $config = DB::table('configs')->find(1);
            $productcat = DB::table('product_cats')->get();
             $view->with('footer_name', $config->title);
             $view->with('footer_address', $config->content_home_1);
             $view->with('footer_phone', $config->content_home_7);
             $view->with('footer_email', $config->content_home_4);
             $view->with('footer_productcat', $productcat);
        });

        View::composer('home.layout', function ($view) {
            $config = DB::table('configs')->find(1);
             $view->with('header_phone', $config->content_home_7);
             $view->with('head_icon', $config->icon);
        });
    }
}