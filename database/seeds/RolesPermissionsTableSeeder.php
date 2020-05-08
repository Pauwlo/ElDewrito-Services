<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = Role::create([
            'name' => 'administrator',
        ]);

        $officialHost = Role::create([
            'name' => 'official-host',
        ]);

        $accessOfficialPlaylists = Permission::create([
            'name' => 'official-playlists.access',
        ]);

        $officialHost->givePermissionTo($accessOfficialPlaylists);
    }
}
