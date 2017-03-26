<?php

use Illuminate\Database\Seeder;

class UserLoginLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Models\UserLoginLog', 100)->create();
    }
}
