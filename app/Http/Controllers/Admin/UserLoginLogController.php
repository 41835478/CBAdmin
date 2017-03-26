<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserLoginLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserLoginLogController extends Controller
{
    public function index(){
        $title = '用户登录日志';
        $data = UserLoginLog::all();
        config(['adminlte.plugins.datatables'=>true]);
        return view('admin.logs.index',[
            'title' => $title,
            'data'  => $data,
        ]);
    }
}
