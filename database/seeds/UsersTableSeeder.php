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
        User::create([
            'name'     => 'Admin',
            'email'    => 'example@domain.com',
            'role'     => 2,
            'password' => Hash::make('changeme'),
        ])->markEmailAsVerified();
    }
}
