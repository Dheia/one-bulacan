<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ModelHasRolesTableSeeder extends Seeder
{
    protected $model_has_roles = [
        [
            'role_id' => "1", 
            'model_type' => 'App\User',
            'model_id' => '1'
        ],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate Model Has Roles Table
        DB::table('model_has_roles')->truncate();
        // Insert Data in Model Has Roles Table
    	DB::table('model_has_roles')->insert($this->model_has_roles);
    }
}
