<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('menus')->insert([
            [
                'name' => '菜单管理',
                'permission' => 'menu-index,menu-update,menu-create,menu-delete',
                'url' => 'admin/menu/index',
                'sort' => 100,
            ],
            [
                'name' => '角色管理',
                'permission' => 'role-index,role-delete,role-create,role-permission,role-updatePermission,role-user,role-update,role-create',
                'url' => 'admin/role/index',
                'sort' => 99,
            ],
            [
                'name' => '用户管理',
                'permission' => 'user-index',
                'url' => 'admin/user/index',
                'sort' => 98,
            ],
            [
                'name' => '敏感词管理',
                'permission' => 'sensitiveword-index,sensitiveword-create',
                'url' => 'admin/words/index',
                'sort' => 97,
            ],
            [
                'name' => '用户登录日志',
                'permission' => 'userloginlog-index',
                'url' => 'admin/logs',
                'sort' => 96,
            ],
        ]);


    }
}
