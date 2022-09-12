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
        //
        DB::table('users')->insert([
            'name' => "Developer",
            'email' => 'dev@tigernethost.com',
            'username' => 'developer',
            'password' => bcrypt('MarkMark$ecurit1')
        ]);
    }
}
