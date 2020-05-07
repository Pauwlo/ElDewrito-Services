<?php

use App\OfficialPlaylists\Command;
use App\OfficialPlaylists\Map;
use App\OfficialPlaylists\Option;
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
        $this->call(OfficialPlaylistsMapsTableSeeder::class);

        // Stock maps
        $diamondback = Map::where('slug', 'diamondback')->first();
        $edge = Map::where('slug', 'edge')->first();
        $guardian = Map::where('slug', 'guardian')->first();
        $highGround = Map::where('slug', 'high-ground')->first();
        $icebox = Map::where('slug', 'icebox')->first();
        $lastResort = Map::where('slug', 'last-resort')->first();
        $narrows = Map::where('slug', 'narrows')->first();
        $reactor = Map::where('slug', 'reactor')->first();
        $sandtrap = Map::where('slug', 'sandtrap')->first();
        $standoff = Map::where('slug', 'standoff')->first();
        $thePit = Map::where('slug', 'the-pit')->first();
        $valhalla = Map::where('slug', 'valhalla')->first();

        // Common commands
        $betrayalLimit = Command::create([
            'command' => 'Server.BetrayalLimit 3',
            'slug' => 'server-betrayallimit-3-12345',
        ]);

        $numberOfTeams = Command::create([
            'command' => 'Server.NumberOfTeams 2',
            'slug' => 'server-numberofteams-2-54321',
        ]);

        // Ranked playlist example
        $rankedBigTeamBattle = RankedPlaylist::create([
            'name' => 'Big Team Battle',
            'server_name' => 'Ranked - Big Team Battle',
            'slug' => 'big-team-battle-12345',
            'message' => "Thanks for playing on the official Ranked Big Team Battle server.\n\nType !help in chat for a list of commands.",
            'max_players' => 16,
            'vote_mode' => 1,
            'number_of_revotes' => 1,
        ]);

        $rbtbTeamBRs = Variant::create([
            'display_name' => 'Team BRs',
            'file_name' => 'RBTB Team BRs',
            'slug' => 'rbtb-team-brs-12345',
        ]);
        
        $rbtbTeamCtf = Variant::create([
            'display_name' => 'Team CTF',
            'file_name' => 'RBTB Team CTF',
            'slug' => 'rbtb-team-ctf-54321',
        ]);

        $rbtbOneFlagCtf = Variant::create([
            'display_name' => 'One Flag CTF',
            'file_name' => 'RBTB One Flag CTF',
            'slug' => 'rbtb-one-flag-ctf-13579',
        ]);

        $rbtbNeutralBombAssault = Variant::create([
            'display_name' => 'Neutral Bomb Assault',
            'file_name' => 'RBTB Neutral Bomb Assault',
            'slug' => 'rbtb-neutral-bomb-assault-24680',
        ]);

        $rbtbTeamBRs->commands()->attach($betrayalLimit);
        $rbtbTeamBRs->commands()->attach($numberOfTeams);
        $rbtbTeamCtf->commands()->attach($betrayalLimit);
        $rbtbTeamCtf->commands()->attach($numberOfTeams);
        $rbtbOneFlagCtf->commands()->attach($betrayalLimit);
        $rbtbOneFlagCtf->commands()->attach($numberOfTeams);
        $rbtbNeutralBombAssault->commands()->attach($betrayalLimit);
        $rbtbNeutralBombAssault->commands()->attach($numberOfTeams);

        $rbtbOptions = [
            Option::create([
                'map_id' => $diamondback->id,
                'variant_id' => $rbtbTeamBRs->id,
                'can_be_veto_result' => true,
                'slug' => '12345',
            ]),
            Option::create([
                'map_id' => $edge->id,
                'variant_id' => $rbtbTeamBRs->id,
                'can_be_veto_result' => true,
                'slug' => '54321',
            ]),
            Option::create([
                'map_id' => $highGround->id,
                'variant_id' => $rbtbTeamBRs->id,
                'can_be_veto_result' => true,
                'slug' => '13579',
            ]),
            Option::create([
                'map_id' => $lastResort->id,
                'variant_id' => $rbtbTeamBRs->id,
                'can_be_veto_result' => true,
                'slug' => '24680',
            ]),
            Option::create([
                'map_id' => $reactor->id,
                'variant_id' => $rbtbTeamBRs->id,
                'can_be_veto_result' => true,
                'slug' => '69420',
            ]),
            Option::create([
                'map_id' => $sandtrap->id,
                'variant_id' => $rbtbTeamBRs->id,
                'can_be_veto_result' => true,
                'slug' => '93170',
            ]),
            Option::create([
                'map_id' => $standoff->id,
                'variant_id' => $rbtbTeamBRs->id,
                'can_be_veto_result' => true,
                'slug' => '29382',
            ]),
            Option::create([
                'map_id' => $valhalla->id,
                'variant_id' => $rbtbTeamBRs->id,
                'can_be_veto_result' => true,
                'slug' => '13377',
            ]),
            Option::create([
                'map_id' => $diamondback->id,
                'variant_id' => $rbtbTeamCtf->id,
                'can_be_veto_result' => true,
                'slug' => '30962',
            ]),
            Option::create([
                'map_id' => $edge->id,
                'variant_id' => $rbtbTeamCtf->id,
                'can_be_veto_result' => true,
                'slug' => '53096',
            ]),
            Option::create([
                'map_id' => $lastResort->id,
                'variant_id' => $rbtbTeamCtf->id,
                'can_be_veto_result' => true,
                'slug' => '56280',
            ]),
            Option::create([
                'map_id' => $sandtrap->id,
                'variant_id' => $rbtbTeamCtf->id,
                'can_be_veto_result' => true,
                'slug' => '86106',
            ]),
            Option::create([
                'map_id' => $standoff->id,
                'variant_id' => $rbtbTeamCtf->id,
                'can_be_veto_result' => true,
                'slug' => '49802',
            ]),
            Option::create([
                'map_id' => $valhalla->id,
                'variant_id' => $rbtbTeamCtf->id,
                'can_be_veto_result' => true,
                'slug' => '28246',
            ]),
            Option::create([
                'map_id' => $edge->id,
                'variant_id' => $rbtbOneFlagCtf->id,
                'can_be_veto_result' => false,
                'slug' => '',
            ]),
            Option::create([
                'map_id' => $highGround->id,
                'variant_id' => $rbtbOneFlagCtf->id,
                'can_be_veto_result' => false,
                'slug' => '18369',
            ]),
            Option::create([
                'map_id' => $lastResort->id,
                'variant_id' => $rbtbOneFlagCtf->id,
                'can_be_veto_result' => false,
                'slug' => '32653',
            ]),
            Option::create([
                'map_id' => $diamondback->id,
                'variant_id' => $rbtbNeutralBombAssault->id,
                'can_be_veto_result' => true,
                'slug' => '82944',
            ]),
            Option::create([
                'map_id' => $edge->id,
                'variant_id' => $rbtbNeutralBombAssault->id,
                'can_be_veto_result' => true,
                'slug' => '36236',
            ]),
            Option::create([
                'map_id' => $standoff->id,
                'variant_id' => $rbtbNeutralBombAssault->id,
                'can_be_veto_result' => true,
                'slug' => '62849',
            ]),
            Option::create([
                'map_id' => $valhalla->id,
                'variant_id' => $rbtbNeutralBombAssault->id,
                'can_be_veto_result' => true,
                'slug' => '98343',
            ]),
        ];

        foreach ($rbtbOptions as $option) {
            $rankedBigTeamBattle->options()->attach($option);
        }
        
        // Social playlist example
        $socialRumblePit = SocialPlaylist::create([
            'name' => 'Rumble Pit',
            'server_name' => 'Social - Rumble Pit',
            'slug' => 'rumble-pit-54321',
            'message' => "Thanks for playing on the official Social Rumble Pit server.\n\nType !help in chat for a list of commands.",
            'max_players' => 8,
            'vote_mode' => 0,
            'number_of_revotes' => 1,
        ]);

        $socialRumblePit->maps()->attach($guardian);
        $socialRumblePit->maps()->attach($highGround);
        $socialRumblePit->maps()->attach($icebox);
        $socialRumblePit->maps()->attach($narrows);
        $socialRumblePit->maps()->attach($standoff);
        $socialRumblePit->maps()->attach($thePit);

        $rpSlayer = Variant::create([
            'display_name' => 'Slayer',
            'file_name' => 'SRP Slayer',
            'slug' => 'srp-slayer-12345',
        ]);

        $rpSlayer->specificMaps()->attach($edge);
        $rpSlayer->specificMaps()->attach($guardian);
        $rpSlayer->specificMaps()->attach($highGround);
        $rpSlayer->specificMaps()->attach($icebox);
        $rpSlayer->specificMaps()->attach($narrows);
        $rpSlayer->specificMaps()->attach($standoff);
        $rpSlayer->specificMaps()->attach($thePit);

        $rpSwords = Variant::create([
            'display_name' => 'Swords',
            'file_name' => 'SRP Swords',
            'slug' => 'srp-swords-54321',
        ]);

        $rpOddball = Variant::create([
            'display_name' => 'Oddball',
            'file_name' => 'SRP Oddball',
            'slug' => 'srp-oddball-13579',
        ]);

        $rpNinjaball = Variant::create([
            'display_name' => 'NinjaBall',
            'file_name' => 'SRP NinjaBall',
            'slug' => 'srp-ninjaball-24680',
        ]);

        $rpCrazyKing = Variant::create([
            'display_name' => 'Crazy King',
            'file_name' => 'SRP Crazy King',
            'slug' => 'srp-crazy-king-69420',
        ]);

        $rpMoshPit = Variant::create([
            'display_name' => 'Mosh Pit',
            'file_name' => 'SRP Mosh Pit',
            'slug' => 'srp-mosh-pit-39410',
        ]);

        $rpJuggernaut = Variant::create([
            'display_name' => 'Juggernaut',
            'file_name' => 'SRP Juggernaut',
            'slug' => 'srp-juggernaut-18632',
        ]);

        $socialRumblePit->variants()->attach($rpSlayer);
        $socialRumblePit->variants()->attach($rpSwords);
        $socialRumblePit->variants()->attach($rpOddball);
        $socialRumblePit->variants()->attach($rpNinjaball);
        $socialRumblePit->variants()->attach($rpCrazyKing);
        $socialRumblePit->variants()->attach($rpMoshPit);
        $socialRumblePit->variants()->attach($rpJuggernaut);
    }
}
