<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttributeTypeDefinitionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attribute_type_definition')->delete();
        
        \DB::table('attribute_type_definition')->insert(array (
            0 => 
            array (
                'attribute_type_id' => 1,
                'attribute_type_name' => 'text',
                'is_active' => 1,
            ),
            1 => 
            array (
                'attribute_type_id' => 2,
                'attribute_type_name' => 'button',
                'is_active' => 0,
            ),
            2 => 
            array (
                'attribute_type_id' => 3,
                'attribute_type_name' => 'checkbox',
                'is_active' => 1,
            ),
            3 => 
            array (
                'attribute_type_id' => 4,
                'attribute_type_name' => 'color',
                'is_active' => 0,
            ),
            4 => 
            array (
                'attribute_type_id' => 5,
                'attribute_type_name' => 'date',
                'is_active' => 1,
            ),
            5 => 
            array (
                'attribute_type_id' => 6,
                'attribute_type_name' => 'datetime-local',
                'is_active' => 0,
            ),
            6 => 
            array (
                'attribute_type_id' => 7,
                'attribute_type_name' => 'email',
                'is_active' => 0,
            ),
            7 => 
            array (
                'attribute_type_id' => 8,
                'attribute_type_name' => 'file',
                'is_active' => 1,
            ),
            8 => 
            array (
                'attribute_type_id' => 9,
                'attribute_type_name' => 'hidden',
                'is_active' => 0,
            ),
            9 => 
            array (
                'attribute_type_id' => 10,
                'attribute_type_name' => 'image',
                'is_active' => 0,
            ),
            10 => 
            array (
                'attribute_type_id' => 11,
                'attribute_type_name' => 'month',
                'is_active' => 0,
            ),
            11 => 
            array (
                'attribute_type_id' => 12,
                'attribute_type_name' => 'number',
                'is_active' => 1,
            ),
            12 => 
            array (
                'attribute_type_id' => 13,
                'attribute_type_name' => 'password',
                'is_active' => 0,
            ),
            13 => 
            array (
                'attribute_type_id' => 14,
                'attribute_type_name' => 'radio',
                'is_active' => 0,
            ),
            14 => 
            array (
                'attribute_type_id' => 15,
                'attribute_type_name' => 'range',
                'is_active' => 0,
            ),
            15 => 
            array (
                'attribute_type_id' => 16,
                'attribute_type_name' => 'reset',
                'is_active' => 0,
            ),
            16 => 
            array (
                'attribute_type_id' => 17,
                'attribute_type_name' => 'search',
                'is_active' => 0,
            ),
            17 => 
            array (
                'attribute_type_id' => 18,
                'attribute_type_name' => 'submit',
                'is_active' => 0,
            ),
            18 => 
            array (
                'attribute_type_id' => 19,
                'attribute_type_name' => 'tel',
                'is_active' => 0,
            ),
            19 => 
            array (
                'attribute_type_id' => 20,
                'attribute_type_name' => 'time',
                'is_active' => 0,
            ),
            20 => 
            array (
                'attribute_type_id' => 21,
                'attribute_type_name' => 'url',
                'is_active' => 0,
            ),
            21 => 
            array (
                'attribute_type_id' => 22,
                'attribute_type_name' => 'week',
                'is_active' => 0,
            ),
            22 => 
            array (
                'attribute_type_id' => 23,
                'attribute_type_name' => 'textarea',
                'is_active' => 1,
            ),
        ));
        
        
    }
}