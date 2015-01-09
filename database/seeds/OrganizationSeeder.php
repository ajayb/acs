<?php

use Illuminate\Database\Seeder;
use App\Organization as Organization;

class OrganizationSeeder extends Seeder {

    public function run()
    {
        // clear table
        Organization::truncate();
        // add 1st row
        Organization::create([
            'id'         => 1,
            'name'       => 'Adaptive Carbonsy Stems',
            'email'      => 'adaptivecarbonsystems@gmail.com',
            'address'    => '',
            'city'       => '',
            'state'      => '',
            'country'    => 'USA',
            'zip_code'   => '',
            'status'     => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);
    }

}
