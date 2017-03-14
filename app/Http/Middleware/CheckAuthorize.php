<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CheckAuthorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $menus = $request->user()->getAuthorizeMenus();

        //设置菜单
        config(['adminlte.menu'=>$menus]);

        $action = Route::currentRouteAction();

        //这里需要检查 action,有可能是空的
        if (!empty($action)){
            $tmpController = explode('\\',$action);
            list($modelStr,$method) = explode('@',array_pop($tmpController));
            $model = strtolower(substr($modelStr,0,-10));
            $currentPermission = $model.'-'.$method;
            if (!$request->user()->can($currentPermission)){
                //无权限则返回403
                return response('permission deny! '.$currentPermission, 403);
            }
        }
        return $next($request);
    }
}
