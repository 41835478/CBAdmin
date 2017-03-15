<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role','user_role','user_id','role_id');
    }

    /**
     * 用户权限判断
     * @param string $ability
     * @param array $arguments
     * @return bool
     */
    public function can($ability, $arguments = [])
    {
        foreach($this->roles as $role){
            if (strtolower($role->name) == 'admin'){
                //return true;
            }
        }

       $permissions = $this->getPermissions();
        if (!in_array(strtolower($ability), $permissions)){
            return false;
        }
        return true;
    }

    /**
     * 获取用户的所有权限
     * @return array
     */
    public function getPermissions()
    {
        $roles = $this->roles;
        if (!$roles) return [];
        $menus = new Collection();
        foreach ($roles as $role) {
            $menus = $menus->merge($role->menus);
        }
        $permissions = [];
        foreach($menus as $menu){
            if ($menu->permission){
                $permissions = array_merge($permissions, explode(',', strtolower($menu->permission)));
            }
        }
        return array_unique($permissions);
    }


    /**
     * 获取用户授权的菜单
     * @return array 二维数组
     */
    public function getAuthorizeMenus()
    {
        $roles = $this->roles;
        if (!$roles) return [];
        $menus = new Collection();
        foreach ($roles as $role) {
            $menus = $menus->merge($role->menus->where('only_permission','<>',1));
        }
        return $this->formatMenus($menus);
    }


    /**
     * 格式为树型
     * @param $menus
     * @param int $pid
     * @return array
     */
    public function formatMenus($menus, $pid=0)
    {
        $tree = [];
        foreach($menus as $key=>$menu) {
            if ($menu['pid'] == $pid) {
                unset($menus[$key]);
                $menu['submenu'] = $this -> formatMenus($menus, $menu['id']);
                $item = [
                    'text' => $menu['name'],
                    'url'  => $menu['url'] ? url($menu['url']) : '',

                ];
                if ($menu['icon']){
                    $item['icon'] = $menu['icon'];
                }
                if ($menu['submenu']) {
                    $item['submenu'] = $menu['submenu'];
                }

                $tree[] = $item;
            }
        }
        return $tree;
    }
}
