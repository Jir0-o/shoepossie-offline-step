<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BackofficeRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('backoffice_role')->delete();
        
        \DB::table('backoffice_role')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'role_name' => 'Super Administrator',
            ),
            1 => 
            array (
                'role_id' => 2,
                'role_name' => 'Super Administrator',
            ),
            2 => 
            array (
                'role_id' => 3,
                'role_name' => 'Casier',
            ),
            3 => 
            array (
                'role_id' => 4,
                'role_name' => 'Chef',
            ),
            4 => 
            array (
                'role_id' => 5,
                'role_name' => 'Waiter',
            ),
        ));
        
        
    }
}