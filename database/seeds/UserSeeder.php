<?php

use Illuminate\Database\Seeder;
use App\User as User;
use App\UserRoles as UserRoles;

class UserSeeder extends Seeder {

    public function run()
    {
        // clear table
        User::truncate();
        // add 1st row
        User::create([
            'id'              => 1,
            'organization_id' => 1,
            'role_id'         => 1,
            'name'            => 'Adaptive Carbon Systems',
            'email'           => 'testmili@gmail.com',
            'password'        => Hash::make('admin'),
            'status'          => 1,
            'created_at'      => new DateTime,
            'updated_at'      => new DateTime,
        ]);
    }
}
