<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'username'=>'ABC'
            'email'=>'abcac.com'
            'password'=>'aaaaa'
            'bio'=>'abc'
            'images'=>''
        ]);
        //
    }
}
