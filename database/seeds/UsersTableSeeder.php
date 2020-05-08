<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'example@domain.com',
            'password' => Hash::make('changeme'),
        ]);

        $admin->markEmailAsVerified();

        $admin->assignRole('administrator');
    }
}
