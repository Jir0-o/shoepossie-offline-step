<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BackofficeLoginTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('backoffice_login')->delete();
        
        \DB::table('backoffice_login')->insert(array (
            0 => 
            array (
                'login_id' => 1,
                'office_user_id' => 999,
                'full_name' => 'ABU BAKAR SIDDIQUE',
                'user_email' => 'abusid@gmail.com',
                'login_user_name' => 'admin',
                'login_user_pass' => '$2y$10$GiWR74K2NwB/CvVkNM9NzOP4kYJPp2ziCMvLWSwG6Om0MOCKJvOBa',
                'user_image' => '202207240549face16.jpg',
                'role_id' => 1,
                'token' => 'ebeb491775e9505a01d18b3d732588a3d272aa21',
                'last_login' => NULL,
                'is_active' => 1,
            ),
            1 => 
            array (
                'login_id' => 2,
                'office_user_id' => 1000,
                'full_name' => 'Moyuri',
                'user_email' => 'moyuri@kaynat.com',
                'login_user_name' => 'Moyuri',
                'login_user_pass' => '$2y$10$.pynO24r7Gq08pOheRqPze5P8bik77qK6MZmgv8vW6wiUIneBNYIS',
                'user_image' => '202207231746face5.jpg',
                'role_id' => 2,
                'token' => NULL,
                'last_login' => NULL,
                'is_active' => 1,
            ),
            2 => 
            array (
                'login_id' => 3,
                'office_user_id' => 1001,
                'full_name' => 'Jui',
                'user_email' => 'jui@thechef.com',
                'login_user_name' => 'Jui',
                'login_user_pass' => '$2y$10$.pynO24r7Gq08pOheRqPze5P8bik77qK6MZmgv8vW6wiUIneBNYIS',
                'user_image' => '202207240544face5.jpg',
                'role_id' => 2,
                'token' => NULL,
                'last_login' => NULL,
                'is_active' => 1,
            ),
            3 => 
            array (
                'login_id' => 4,
                'office_user_id' => 1002,
                'full_name' => 'Khalid',
                'user_email' => 'khalid@thechef.com',
                'login_user_name' => 'Khalid',
                'login_user_pass' => '$2y$10$.pynO24r7Gq08pOheRqPze5P8bik77qK6MZmgv8vW6wiUIneBNYIS',
                'user_image' => '202207240551face13.jpg',
                'role_id' => 2,
                'token' => NULL,
                'last_login' => NULL,
                'is_active' => 1,
            ),
            4 => 
            array (
                'login_id' => 5,
                'office_user_id' => 1003,
                'full_name' => 'Munna',
                'user_email' => 'munna@thechef.com',
                'login_user_name' => 'Munna',
                'login_user_pass' => '$2y$10$.pynO24r7Gq08pOheRqPze5P8bik77qK6MZmgv8vW6wiUIneBNYIS',
                'user_image' => '202207240551face10.jpg',
                'role_id' => 3,
                'token' => NULL,
                'last_login' => NULL,
                'is_active' => 1,
            ),
            5 => 
            array (
                'login_id' => 6,
                'office_user_id' => 1004,
                'full_name' => 'Ritu',
                'user_email' => 'ritu@thechef.com',
                'login_user_name' => 'Ritu',
                'login_user_pass' => '$2y$10$.pynO24r7Gq08pOheRqPze5P8bik77qK6MZmgv8vW6wiUIneBNYIS',
                'user_image' => '202207240552face26.jpg',
                'role_id' => 5,
                'token' => NULL,
                'last_login' => NULL,
                'is_active' => 1,
            ),
            6 => 
            array (
                'login_id' => 7,
                'office_user_id' => 1005,
                'full_name' => 'Rasel',
                'user_email' => 'hasan@email.com',
                'login_user_name' => 'Rasel',
                'login_user_pass' => '$2y$10$.pynO24r7Gq08pOheRqPze5P8bik77qK6MZmgv8vW6wiUIneBNYIS',
                'user_image' => '202207231733user.webp',
                'role_id' => 2,
                'token' => NULL,
                'last_login' => NULL,
                'is_active' => 1,
            ),
            7 => 
            array (
                'login_id' => 8,
                'office_user_id' => 1006,
                'full_name' => 'Emon',
                'user_email' => 'emon@thechef.com',
                'login_user_name' => 'Emon',
                'login_user_pass' => '$2y$10$.pynO24r7Gq08pOheRqPze5P8bik77qK6MZmgv8vW6wiUIneBNYIS',
                'user_image' => '202207240554face12.jpg',
                'role_id' => 3,
                'token' => NULL,
                'last_login' => NULL,
                'is_active' => 1,
            ),
            8 => 
            array (
                'login_id' => 9,
                'office_user_id' => 1007,
                'full_name' => 'Md.Kamrul Hasan',
                'user_email' => 'kamrul@ussbd.com',
                'login_user_name' => 'Kamrul',
                'login_user_pass' => '$2y$10$l.hH/Ht.QktYBmQzmCgIv.3T9mhNisQ7ezYGTIfhDwS/OKXXT52ZW',
                'user_image' => NULL,
                'role_id' => 1,
                'token' => NULL,
                'last_login' => NULL,
                'is_active' => 1,
            ),
        ));
        
        
    }
}