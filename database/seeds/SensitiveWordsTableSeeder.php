<?php

use Illuminate\Database\Seeder;

class SensitiveWordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = count(config('sensitive.words'));
        factory('App\Models\SensitiveWord', $count)->create();
    }
}
