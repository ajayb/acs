<?php

use Illuminate\Database\Seeder;
use App\Roles as Roles;

class RolesSeeder extends Seeder {

    public function run()
    {
        // clear table
        Roles::truncate();
        // add 1st row
        Roles::create([
            'id'   => 1,
            'name' => 'admin'
        ]);

        Roles::create([
            'id'   => 2,
            'name' => 'manager'
        ]);

        Roles::create([
            'id'   => 3,
            'name' => 'operator'
        ]);
    }

}
