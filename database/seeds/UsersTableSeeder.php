<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'username'=>'ABC',
            'email'=>'abc@ac.com',
            'password'=>'aaaaa',
            'bio'=>'abc',
            'images'=>'',
        ]);
        //
    }
}
