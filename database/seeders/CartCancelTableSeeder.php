<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CartCancelTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cart_cancel')->delete();
        
        
        
    }
}