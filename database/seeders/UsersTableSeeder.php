<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $code = substr(md5(uniqid(mt_rand(), true)) , 0, 7);

        DB::table('users')->insert([
            'code'  => $code,
            'name'  => "Developer",
            'email' => 'dev@tigernethost.com',
            'username' => 'developer',
            'password' => bcrypt('MarkMark$ecurit1'),
            'is_admin' => 1,
            'is_first_time_login' => 0,
        ]);
    }
}
