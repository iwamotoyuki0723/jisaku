<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'name' => '管理者',
            'email' => 'kanri@kanri.com',
            'password' => 'kanri1234',
            'store_id' => 0,
            'is_admin' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
