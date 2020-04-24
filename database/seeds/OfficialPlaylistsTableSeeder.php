<?php

use App\OfficialPlaylists\Map;
use App\OfficialPlaylists\SocialPlaylist;
use App\OfficialPlaylists\RankedPlaylist;
use App\OfficialPlaylists\Variant;
use Illuminate\Database\Seeder;

class OfficialPlaylistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RankedPlaylist::create([
            'name' => 'Big Team Battle',
            'server_name' => 'Ranked - Big Team Battle',
            'slug' => 'big-team-battle-12345',
            'message' => "Thanks for playing on the official Ranked Big Team Battle server.\n\nType !help in chat for a list of commands.",
            'max_players' => 16,
            'vote_mode' => 1,
            'number_of_revotes' => 1,
        ]);
        
        SocialPlaylist::create([
            'name' => 'Rumble Pit',
            'server_name' => 'Social - Rumble Pit',
            'slug' => 'rumble-pit-54321',
            'message' => "Thanks for playing on the official Social Rumble Pit server.\n\nType !help in chat for a list of commands.",
            'max_players' => 8,
            'vote_mode' => 0,
            'number_of_revotes' => 1,
        ]);
        
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

        // Variant examples
        Variant::create([
            'display_name' => 'Slayer',
            'file_name' => 'Slayer',
            'slug' => 'slayer-12345',
        ]);
        
        Variant::create([
            'display_name' => 'Team CTF',
            'file_name' => 'Team CTF',
            'slug' => 'team-ctf-54321',
        ]);
    }
}
