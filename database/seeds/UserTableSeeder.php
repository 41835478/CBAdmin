<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstOrCreate([
            'name' => 'maxhuang',
            'email' => 'max@fcuh.com',
            'password' => bcrypt('123456'),
        ]);

        $roles = Role::all();
        foreach ($roles as $role) {
            $admin->roles()->attach($role->id);
        }

        $icp = User::create([
            'name' => 'icptest',
            'email' => 'icptest@fcuh.com',
            'password' => bcrypt('123456'),
        ]);
        $icp->roles()->attach($roles->where('name','ICP测试')->first()->id);

    }
}
