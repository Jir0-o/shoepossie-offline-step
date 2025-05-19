<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttributeDefinitionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attribute_definition')->delete();
        
        \DB::table('attribute_definition')->insert(array (
            0 => 
            array (
                'attribute_id' => 1,
                'attribute_name' => 'Color',
                'attribute_type_id' => 3,
                'is_active' => 1,
            ),
            1 => 
            array (
                'attribute_id' => 2,
                'attribute_name' => 'Size',
                'attribute_type_id' => 3,
                'is_active' => 1,
            ),
            2 => 
            array (
                'attribute_id' => 3,
            'attribute_name' => 'vat (%)',
                'attribute_type_id' => 1,
                'is_active' => 0,
            ),
            3 => 
            array (
                'attribute_id' => 4,
            'attribute_name' => 'Tax (%)',
                'attribute_type_id' => 1,
                'is_active' => 0,
            ),
            4 => 
            array (
                'attribute_id' => 5,
                'attribute_name' => 'Bonus Point',
                'attribute_type_id' => 1,
                'is_active' => 0,
            ),
            5 => 
            array (
                'attribute_id' => 6,
                'attribute_name' => 'Discount',
                'attribute_type_id' => 12,
                'is_active' => 0,
            ),
            6 => 
            array (
                'attribute_id' => 7,
                'attribute_name' => 'Brand',
                'attribute_type_id' => 1,
                'is_active' => 0,
            ),
            7 => 
            array (
                'attribute_id' => 8,
                'attribute_name' => 'Product Details',
                'attribute_type_id' => 23,
                'is_active' => 0,
            ),
            8 => 
            array (
                'attribute_id' => 10,
                'attribute_name' => 'Processor',
                'attribute_type_id' => 1,
                'is_active' => 0,
            ),
            9 => 
            array (
                'attribute_id' => 11,
                'attribute_name' => 'Storage & RAM',
                'attribute_type_id' => 1,
                'is_active' => 0,
            ),
            10 => 
            array (
                'attribute_id' => 12,
                'attribute_name' => 'Display',
                'attribute_type_id' => 1,
                'is_active' => 0,
            ),
            11 => 
            array (
                'attribute_id' => 13,
                'attribute_name' => 'Camera',
                'attribute_type_id' => 1,
                'is_active' => 0,
            ),
            12 => 
            array (
                'attribute_id' => 14,
                'attribute_name' => 'Charging & Battery',
                'attribute_type_id' => 1,
                'is_active' => 0,
            ),
            13 => 
            array (
                'attribute_id' => 15,
                'attribute_name' => 'Size & Weight',
                'attribute_type_id' => 1,
                'is_active' => 0,
            ),
            14 => 
            array (
                'attribute_id' => 16,
                'attribute_name' => 'Operating System',
                'attribute_type_id' => 1,
                'is_active' => 0,
            ),
            15 => 
            array (
                'attribute_id' => 17,
                'attribute_name' => 'Warranty',
                'attribute_type_id' => 1,
                'is_active' => 1,
            ),
            16 => 
            array (
                'attribute_id' => 18,
                'attribute_name' => 'Country',
                'attribute_type_id' => 1,
                'is_active' => 0,
            ),
            17 => 
            array (
                'attribute_id' => 19,
                'attribute_name' => 'Kit Type',
                'attribute_type_id' => 1,
                'is_active' => 0,
            ),
            18 => 
            array (
                'attribute_id' => 20,
                'attribute_name' => 'Bicycle Code',
                'attribute_type_id' => 1,
                'is_active' => 1,
            ),
            19 => 
            array (
                'attribute_id' => 21,
                'attribute_name' => 'Frame Size',
                'attribute_type_id' => 1,
                'is_active' => 1,
            ),
            20 => 
            array (
                'attribute_id' => 22,
                'attribute_name' => 'Material',
                'attribute_type_id' => 1,
                'is_active' => 1,
            ),
            21 => 
            array (
                'attribute_id' => 23,
                'attribute_name' => 'Rim',
                'attribute_type_id' => 1,
                'is_active' => 1,
            ),
            22 => 
            array (
                'attribute_id' => 24,
                'attribute_name' => 'Frame',
                'attribute_type_id' => 1,
                'is_active' => 1,
            ),
            23 => 
            array (
                'attribute_id' => 25,
                'attribute_name' => 'Fork',
                'attribute_type_id' => 1,
                'is_active' => 1,
            ),
            24 => 
            array (
                'attribute_id' => 26,
                'attribute_name' => 'Handlebar',
                'attribute_type_id' => 1,
                'is_active' => 1,
            ),
            25 => 
            array (
                'attribute_id' => 27,
                'attribute_name' => 'Breakset',
                'attribute_type_id' => 1,
                'is_active' => 1,
            ),
            26 => 
            array (
                'attribute_id' => 28,
                'attribute_name' => 'Brake lever',
                'attribute_type_id' => 1,
                'is_active' => 1,
            ),
            27 => 
            array (
                'attribute_id' => 29,
                'attribute_name' => 'Crankset',
                'attribute_type_id' => 1,
                'is_active' => 1,
            ),
            28 => 
            array (
                'attribute_id' => 30,
                'attribute_name' => 'Tire',
                'attribute_type_id' => 1,
                'is_active' => 1,
            ),
        ));
        
        
    }
}