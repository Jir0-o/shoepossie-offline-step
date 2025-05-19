<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BannerInformationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('banner_information')->delete();
        
        \DB::table('banner_information')->insert(array (
            0 => 
            array (
                'id' => 1,
                'banner_url' => 'https://kaynat.nescostore.com',
            'banner_address' => 'Niral Mor (Opposite of Nirala Police Fari), Khulna',
                'banner_mobile' => '+8801797073796',
                'banner_email' => 'contact@tkaynat.nescostore.com',
                'banner_name' => 'Kaynat',
                'banner_logo' => 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg',
                'is_active' => 1,
            ),
        ));
        
        
    }
}