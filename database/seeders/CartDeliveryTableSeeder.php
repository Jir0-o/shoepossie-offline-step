<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CartDeliveryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cart_delivery')->delete();
        
        
        
    }
}