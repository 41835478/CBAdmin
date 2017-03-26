<?php

namespace App\Http\Controllers\Admin;

use App\Models\SensitiveWord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SensitiveWordController extends Controller
{
    //
    public function index(){
        $title = '敏感词管理';
        $data = SensitiveWord::orderBy('id','desc')->paginate();
        return view('admin.sensitive_word.index',[
            'title' => $title,
            'data'  => $data,
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input('word');
            if (SensitiveWord::create($data)){
                return redirect('admin/words/index')->with('success','添加成功！');
            } else {
                return redirect()->back();
            }
        }
        $word = new SensitiveWord();
        return view('admin.sensitive_word.create',['word'=>$word, 'title'=>'添加敏感词']);
    }
}
