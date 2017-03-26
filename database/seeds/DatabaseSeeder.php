<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //系统需要按[菜单-角色-用户]顺序生成数据
        $this->call(MenusTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SensitiveWordsTableSeeder::class);
        $this->call(UserLoginLogsTableSeeder::class);
    }
}
