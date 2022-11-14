<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShopType;

class ShopTypesTableSeeder extends Seeder
{
    public function run()
    {
        ShopType::create([
            'name' => '病院',
        ]);
        ShopType::create([
            'name' => '診療所',
        ]);
        ShopType::create([
            'name' => '訪問看護',
        ]);
        ShopType::create([
            'name' => '訪問介護',
        ]);
        ShopType::create([
            'name' => '介護施設',
        ]);
        ShopType::create([
            'name' => '居宅介護事業所',
        ]);
        ShopType::create([
            'name' => 'その他サービス',
        ]);
    }
}
