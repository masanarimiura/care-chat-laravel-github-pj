<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RelationTypesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ShopTypesTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
    }
}
