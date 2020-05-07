<?php

use App\OfficialPlaylists\Map;
use Illuminate\Database\Seeder;

class OfficialPlaylistsMapsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Stock maps
        Map::create([
            'display_name' => 'Diamondback',
            'file_name' => 's3d_avalanche',
            'slug' => 'diamondback',
        ]);

        Map::create([
            'display_name' => 'Edge',
            'file_name' => 's3d_edge',
            'slug' => 'edge',
        ]);

        Map::create([
            'display_name' => 'Guardian',
            'file_name' => 'guardian',
            'slug' => 'guardian',
        ]);

        Map::create([
            'display_name' => 'High Ground',
            'file_name' => 'deadlock',
            'slug' => 'high-ground',
        ]);

        Map::create([
            'display_name' => 'Icebox',
            'file_name' => 's3d_turf',
            'slug' => 'icebox',
        ]);

        Map::create([
            'display_name' => 'Last Resort',
            'file_name' => 'zanzibar',
            'slug' => 'last-resort',
        ]);

        Map::create([
            'display_name' => 'Narrows',
            'file_name' => 'chill',
            'slug' => 'narrows',
        ]);

        Map::create([
            'display_name' => 'Reactor',
            'file_name' => 's3d_reactor',
            'slug' => 'reactor',
        ]);

        Map::create([
            'display_name' => 'Sandtrap',
            'file_name' => 'shrine',
            'slug' => 'sandtrap',
        ]);

        Map::create([
            'display_name' => 'Standoff',
            'file_name' => 'bunkerworld',
            'slug' => 'standoff',
        ]);

        Map::create([
            'display_name' => 'The Pit',
            'file_name' => 'cyberdyne',
            'slug' => 'the-pit',
        ]);

        Map::create([
            'display_name' => 'Valhalla',
            'file_name' => 'riverworld',
            'slug' => 'valhalla',
        ]);
    }
}
