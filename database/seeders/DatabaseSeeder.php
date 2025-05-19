<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PurchaseInfoTableSeeder::class);
        $this->call(PurchaseDetailsTableSeeder::class);
        $this->call(AttributeDefinitionTableSeeder::class);
        $this->call(AttributeTypeDefinitionTableSeeder::class);
        $this->call(BackofficeLoginTableSeeder::class);
        $this->call(BackofficeRoleTableSeeder::class);
        $this->call(BannerInformationTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(CartCancelTableSeeder::class);
        $this->call(CartDeliveryTableSeeder::class);
    }
}
