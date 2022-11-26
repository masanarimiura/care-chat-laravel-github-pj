<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopsTableSeeder extends Seeder
{
    public function run()
    {
        Shop::create([
            'name' => '墨田総合病院',
            'shop_type_id' => '1',
            'email' => 'dkflhjadf@icloud.com',
            'number' => '3919783718237',
        ]);
        Shop::create([
            'name' => '小野田クリニック',
            'shop_type_id' => '2',
            'email' => 'dkflhjasaddf@icloud.com',
            'number' => '3953483718237',
        ]);
        Shop::create([
            'name' => '墨田訪問介護',
            'shop_type_id' => '4',
            'email' => 'dkflhjafdsadf@icloud.com',
            'number' => '39193718237',
        ]);
        Shop::create([
            'name' => '神田居宅',
            'shop_type_id' => '6',
            'email' => 'dafdsadf@icloud.com',
            'number' => '3919783998937',
        ]);
    }
}
