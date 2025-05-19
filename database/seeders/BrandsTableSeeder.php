<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'brand_id' => 1,
                'brand_name' => 'Xiaomi',
                'brand_logo' => '202210011664652253Xiaomi.webp',
                'is_active' => 1,
            ),
            1 => 
            array (
                'brand_id' => 2,
                'brand_name' => 'Haylou',
                'brand_logo' => '202210011664652012haylou-logo_brandlogos.net_87uuz.webp',
                'is_active' => 1,
            ),
            2 => 
            array (
                'brand_id' => 3,
                'brand_name' => 'Realme',
                'brand_logo' => '202210011664652227Realme_10.webp',
                'is_active' => 1,
            ),
            3 => 
            array (
                'brand_id' => 4,
                'brand_name' => 'Mibro',
                'brand_logo' => '202210011664652172mibro.webp',
                'is_active' => 1,
            ),
            4 => 
            array (
                'brand_id' => 5,
                'brand_name' => 'Duranta Bicycle',
                'brand_logo' => '202210011664651846d.webp',
                'is_active' => 1,
            ),
            5 => 
            array (
                'brand_id' => 6,
                'brand_name' => 'Redmi',
                'brand_logo' => '202210011664652281redmilogo_small_1547098405877.webp',
                'is_active' => 1,
            ),
            6 => 
            array (
                'brand_id' => 7,
                'brand_name' => 'IMILAB',
                'brand_logo' => '202210011664652067imid.webp',
                'is_active' => 1,
            ),
            7 => 
            array (
                'brand_id' => 8,
                'brand_name' => 'HONOR',
                'brand_logo' => '202210011664652034Honor-Logo.webp',
                'is_active' => 1,
            ),
            8 => 
            array (
                'brand_id' => 9,
                'brand_name' => 'MObvoi',
                'brand_logo' => '202210011664652192Mobvoi-logo-4-e1601639074609.webp',
                'is_active' => 1,
            ),
            9 => 
            array (
                'brand_id' => 10,
                'brand_name' => 'Kieslect',
                'brand_logo' => '202210011664652129kies.webp',
                'is_active' => 1,
            ),
            10 => 
            array (
                'brand_id' => 11,
                'brand_name' => 'OnePlus',
                'brand_logo' => '202210011664652212OnePlus-Logo.wine.webp',
                'is_active' => 1,
            ),
            11 => 
            array (
                'brand_id' => 12,
                'brand_name' => 'Lenovo',
                'brand_logo' => '202210021664711769Lenovo.webp',
                'is_active' => 1,
            ),
            12 => 
            array (
                'brand_id' => 13,
                'brand_name' => 'Apple',
                'brand_logo' => '202210221666432814download.webp',
                'is_active' => 1,
            ),
            13 => 
            array (
                'brand_id' => 14,
                'brand_name' => 'Samsung',
                'brand_logo' => '20221022166643486710.webp',
                'is_active' => 1,
            ),
            14 => 
            array (
                'brand_id' => 15,
                'brand_name' => 'Amazfit',
                'brand_logo' => '202210231666517848download.webp',
                'is_active' => 1,
            ),
            15 => 
            array (
                'brand_id' => 16,
                'brand_name' => 'Adidas',
                'brand_logo' => '202210231666522529adidas.webp',
                'is_active' => 1,
            ),
            16 => 
            array (
                'brand_id' => 17,
                'brand_name' => 'Puma',
                'brand_logo' => '202210281666967417Puma_logo.webp',
                'is_active' => 1,
            ),
            17 => 
            array (
                'brand_id' => 18,
                'brand_name' => 'NIke',
                'brand_logo' => '202210281666967432nike_logo.webp',
                'is_active' => 1,
            ),
            18 => 
            array (
                'brand_id' => 19,
                'brand_name' => 'Calvin Klein',
                'brand_logo' => '202210281666967477calvin_klein_logo.webp',
                'is_active' => 1,
            ),
            19 => 
            array (
                'brand_id' => 20,
                'brand_name' => 'Wrangler',
                'brand_logo' => '202210281666967496wrangler_logo.webp',
                'is_active' => 1,
            ),
            20 => 
            array (
                'brand_id' => 21,
                'brand_name' => 'Rookies',
                'brand_logo' => '202210281666967536rookies-logo.webp',
                'is_active' => 1,
            ),
            21 => 
            array (
                'brand_id' => 22,
                'brand_name' => 'Collins',
                'brand_logo' => '202210281666967709Colin_s-logo.webp',
                'is_active' => 1,
            ),
        ));
        
        
    }
}