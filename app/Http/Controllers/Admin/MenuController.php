<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class MenuController extends Controller
{
    /**
     * 菜单列表
     * @param Request $request
     * @return $this|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $menu = new Menu();
        $data = Menu::orderBy('sort', 'desc')->get();
        if ($request->isMethod('post')) {
            $menus = $menu->formatMenus4Tree($data);
            return response($menus);
        }
        $data = $menu->formatMenus4List($data);
        return view('admin.menu.index')->with('menus',$data);
    }


    /**
     * 创建菜单
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request, $pid=0)
    {
        $menu = new Menu();

        if ($request->isMethod('POST')) {
            $data = $request->input('menu');
            //控制器验证
            $this->validate($request,[
                'menu.name' => 'required|min:3|max:20',
            ],[],[
                'menu.name' => '菜单名称',
            ]);

            foreach ($data as $key => $val){
                if (!empty($val)) $menu->$key = $val;
            }
            if ($menu->save()) {
                return redirect('admin/menu/index')->with('success','添加成功！');
            } else {
                return redirect()->back();
            }

        }

        //添加子菜单用到
        if ($pid) $menu->pid = $pid;

        $menus = Menu::orderBy('sort','desc')->get();
        $menus = $menu->formatMenus4List($menus);
        return view('admin.menu.create',['menus'=>$menus, 'menu'=>$menu]);
    }

    /**
     * 删除菜单
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $menu = Menu::find($id);

        if ($menu->delete()) {
            //删除 role_menu 关系表
            $menu->roles()->detach();
            return redirect('admin/role/index')->with('success', '删除成功-'.$id);
        } else {
            return redirect('admin/role/index')->with('error','删除失败-'.$id);
        }
    }

    /**
     * 编辑菜单
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(Request $request, $id){
        $menu = Menu::find($id);

        if ($request->isMethod('POST')){
            //控制器验证
            $this->validate($request,[
                'menu.name' => 'required|min:3|max:20',
                'menu.icon' => 'present',
                'menu.sort' => 'present|integer',
                'menu.permission' => 'present',
                'menu.url' => 'present',
                'menu.pid' => 'not_in:'.$id,
            ],[],[
                'menu.name' => '菜单名称',
                'menu.icon' => '图标',
                'menu.sort' => '排序',
                'menu.permission' => '菜单权限',
                'menu.url' => '菜单链接',
                'menu.pid' => '上级菜单',
            ]);
            $data = $request->input('menu');
            $menu->name = $data['name'];
            $menu->icon = $data['icon'];
            $menu->sort = $data['sort'];
            $menu->permission = $data['permission'];
            $menu->only_permission = $data['only_permission'];
            $menu->url = $data['url'];
            $menu->pid = $data['pid'];
            if ($menu->save()) {
                return redirect('admin/menu/index')->with('success', '编辑菜单成功-'.$id);
            } else {
                return redirect('admin/menu/index')->with('error','编辑菜单失败-'.$id);
            }
        }

        $menus = Menu::orderBy('sort','desc')->get();
        $menus = $menu->formatMenus4List($menus);
        return view('admin.menu.update',['menu'=>$menu,'menus'=>$menus]);
    }
}
