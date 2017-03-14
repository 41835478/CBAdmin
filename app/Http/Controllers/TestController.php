<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function test(Request $request){
        //dump($request->user()->getPermissions());
        //dump($request->user()->getAuthorizeMenus());
        //dump(Menu::All());
        echo json_encode($request->user()->getAuthorizeMenus());
    }
}
