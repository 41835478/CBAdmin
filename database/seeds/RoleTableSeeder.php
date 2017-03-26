<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Menu;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = Role::create([
            'name' => '管理员'
        ]);

        $icp = Role::create([
            'name' => 'ICP测试'
        ]);

        $allMenus = Menu::all();

        foreach($allMenus as $menu) {
            $admin->menus()->attach($menu->id);
        }
        $icp->menus()->attach($allMenus->where('name','敏感词管理')->first()->id);
        $icp->menus()->attach($allMenus->where('name','用户登录日志')->first()->id);
    }
}
