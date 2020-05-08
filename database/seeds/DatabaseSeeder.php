<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesPermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(OfficialPlaylistsTableSeeder::class);
    }
}
