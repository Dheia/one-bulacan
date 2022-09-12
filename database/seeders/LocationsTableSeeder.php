<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();
        DB::table('locations')->truncate();
        Schema::enableForeignKeyConstraints();

        $locations = [
        	['name' => "Angeles City"],
        	['name' => "Apalit"],
        	['name' => "Arayat"],
        	['name' => "Bacolor"],
        	['name' => "Candaba"],
        	['name' => "Clark"],
        	['name' => "Floridablanca"],
        	['name' => "Guagua"],
        	['name' => "Mabalacat City"],
        	['name' => "Macabebe"],
        	['name' => "Magalang"],
        	['name' => "Masantol"],
        	['name' => "Mexico"],
        	['name' => "Minalin"],
        	['name' => "Porac"],
        	['name' => "San Fernando City"],
        	['name' => "San Luis"],
        	['name' => "San Simon"],
        	['name' => "Santa Ana"],
        	['name' => "Santo Tomas"],
			['name' => "Sasmuan"],
			['name' => "Lubao"],
			['name' => "Santa Rita"]
        ];

        // foreach($locations as $item){
        	DB::table('locations')->insert($locations);
        // }
       
    }
}