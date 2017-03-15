<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events, Request $request)
    {
        //此处为了记录DB的SQL
        DB::listen(function ($query) {
            Log::info($query->sql,['bindings'=>$query->bindings,'time'=>$query->time]);
        });

        //设置菜单
        $events->listen(BuildingMenu::class, function  (BuildingMenu $event) use($request){
            $menus = $request->user()->getAuthorizeMenus();
            $event->menu->add(['text'=>'系统首页','url'=>url('admin/home'),'icon'=>'home']);
            $event->menu->add(...$menus);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
