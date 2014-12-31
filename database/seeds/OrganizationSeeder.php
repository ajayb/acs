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
            'name'     => 'University of Test',
            'email'    => 'testmili@gmail.com',
            'address'  => '',
            'city'     => '',
            'state'    => '',
            'country'  => 'USA',
            'zip_code' => '',
            'phone'    => '',
            'fax'      => '',
            'status'   => '1'
        ]);       
    }
}