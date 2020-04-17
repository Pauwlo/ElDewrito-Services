<?php

use App\OfficialPlaylists\SocialPlaylist;
use App\OfficialPlaylists\RankedPlaylist;
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
    }
}
