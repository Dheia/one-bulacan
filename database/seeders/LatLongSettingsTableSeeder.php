<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LatLongSettingsTableSeeder extends Seeder
{
    protected $settings = [
        [
            'key'         => 'latitude',
            'name'        => 'Latitude',
            'description' => 'Default Google Maps Latitude',
            'value'       => '15.04426482138687',
            'field'       => '{"name":"value","label":"Value","type":"number"}',
            'active'      => 1,
        ],
        [
            'key'           => 'longitude',
            'name'          => 'Longitude',
            'description'   => 'Default Google Maps Longitude',
            'value'         => '120.68958740315281',
            'field'         => '{"name":"value","label":"Value","type":"number"}',
            'active'        => 1,

        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert($this->settings);
    }
}
