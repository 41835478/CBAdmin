<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    /*protected $fillable = [
        'pid',
        'name',
        'icon',
        'permission',
        'only_permission',
        'url',
        'active',
        'description',
        'sort',
    ];*/
    //
    /**
     * 格式化为树型
     * @param $menus
     * @param int $pid
     * @return array
     */
    public function formatMenus4Tree($menus, $pid=0)
    {
        $tree = [];
        foreach ($menus as $key => $menu) {
            if ($menu['pid'] == $pid) {
                unset($menus[$key]);
                $menu['nodes'] = $this->formatMenus4Tree($menus, $menu['id']);
                $item = [
                    'text' => $menu['name'],
                    'url' => $menu['url'],
                    'id' => $menu['id'],
                ];
                if ($menu['icon']) {
                    $item['icon'] = $menu['icon'];
                }
                if ($menu['nodes']) {
                    $item['nodes'] = $menu['nodes'];
                }
                if ($menu['state']) {
                    $item['state'] = $menu['state'];
                }
                $tree[] = $item;
            }
        }
        return $tree;
    }

    /**
     * 格式化为列表形式，适合表格展示
     * @param $menus
     * @param int $pid
     * @param int $level
     * @return array
     */
    public function formatMenus4List($menus, $pid=0, $level=1)
    {
        $tree = [];
        $preSpace = "";
        $prefix = '|--';
        for($i = 1; $i < $level; $i++){
            $preSpace .= '&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        $prefix = $preSpace.$prefix;

        foreach ($menus as $key => $menu) {
            if ($menu['pid'] == $pid) {
                $menu['name'] = $prefix.$menu['name'];
                unset($menus[$key]);
                $tree[] = $menu;
                $subLevel = $level+1;
                $subMenu = $this->formatMenus4List($menus, $menu['id'], $subLevel);
                $tree = array_merge($tree,$subMenu);
            }

        }
        return $tree;
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role','role_menu','menu_id','role_id');
    }
}
