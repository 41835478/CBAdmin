<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * 角色列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = Role::orderBy('sort', 'desc')->paginate();
        return view('admin.role.index', ['data'=>$data, 'title'=>'角色列表']);
    }

    /**
     * 创建角色
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input('role');
            if (Role::create($data)){
                return redirect('admin/role/index')->with('success','添加成功！');
            } else {
                return redirect()->back();
            }
        }
        $role = new Role();
        return view('admin.role.create',['role'=>$role, 'title'=>'创建角色']);
    }

    /**
     * 编辑角色
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\Viewg
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if ($request->isMethod('post')) {
            $data = $request->input('role');
            $role->name = $data['name'];
            $role->sort = $data['sort'];

            if ($role->save()) {
                return redirect('admin/role/index')->with('success', '编辑角色成功-'.$id);
            } else {
                return redirect('admin/role/index')->with('error','编辑角色失败-'.$id);
            }
        }
        return view('admin.role.update',['role'=>$role, 'title'=>'编辑角色']);
    }

    /** 查看角色权限
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function permission(Request $request, $id)
    {
        $role = Role::find($id);
        if ($request->isMethod('post')){
            $menu = new Menu();
            $menus = $menu->orderBy('sort', 'desc')->get();

            $roleMenus = $role->menus;
            foreach($menus as $key => $m){
                foreach($roleMenus as $rm){
                    if($rm->id == $m->id){
                        $menus[$key]['state'] = ['checked'=>true];
                        continue;
                    }
                }
            }
            $menus = $menu->formatMenus4Tree($menus);
            return response($menus);
        }

        return view('admin.role.permission',['data_url'=>url('admin/role/permission/'.$id), 'title'=>'编辑角色权限','role'=>$role]);
    }

    /**
     * 编辑角色权限
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePermission(Request $request, $id)
    {
        $role = Role::find($id);
        $menuIds = $request->input('menuIds');
        $menuIdArr = explode(',',$menuIds);
        try{
            DB::beginTransaction();
            $role->menus()->detach(); //删除多对多关联
            $role->menus()->attach($menuIdArr); //添加多对多关联
        }catch (\Exception $e){
            DB::rollback();
            return redirect()->back();
        }
        DB::commit();
        return redirect('admin/role/index')->with('success', '编辑角色权限成功-'.$id);
    }

    /**
     * 设置角色用户
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|void
     */
    public function user(Request $request, $id)
    {
        $role = Role::find($id);
        if ($request->isMethod('post')){
            $userIds = $request->input('userIds');
            if ($role->users()->attach($userIds)){
                return redirect('admin/role/user/id/'.$id)->with('success', '添加用户成功-'.$id);
            } else {
                return redirect()->back();
            }
            return;
        }

        $users = $role->users;
        $selectedUserIds = $users->implode('id', ',');
        $selectedUserIdsArray = explode(',', $selectedUserIds);
        $optionUsers = User::whereNotIn('id', $selectedUserIdsArray)->get();
        return view('admin.role.user',[
            'data' => $users,
            'title' => '设置用户',
            'optionUsers' => $optionUsers,
            'role' => $role,
        ]);
    }

    /**
     * 移除角色用户
     * @param Request $request
     * @param $id
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser(Request $request, $id, $userId)
    {
        $role = Role::find($id);
        if ($role->users()->detach($userId)){
            return redirect()->back()->with('success','移除用户成功,角色ID-'.$id.',用户ID-'.$userId);
        } else {
            return redirect()->back()->with('error','移除用户失败,角色ID-'.$id.',用户ID-'.$userId);
        }
    }

    public function delete($id){
        $role = Role::find($id);

        if ($role->delete()) {
            //删除 role_menu、user_role 关系表
            $role->menus()->detach();
            $role->users()->detach();
            return redirect('admin/menu/index')->with('success', '删除成功-'.$id);
        } else {
            return redirect('admin/menu/index')->with('error','删除失败-'.$id);
        }
    }

}
