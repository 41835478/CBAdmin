<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        $data = User::paginate();
        return view('admin.user.index',['data'=>$data,'title'=>'用户列表']);
    }
}
