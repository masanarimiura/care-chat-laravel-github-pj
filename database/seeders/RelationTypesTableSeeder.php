<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RelationType;

class RelationTypesTableSeeder extends Seeder
{
    public function run()
    {
        RelationType::create([
            'name' => '本人',
        ]);
        RelationType::create([
            'name' => '夫',
        ]);
        RelationType::create([
            'name' => '妻',
        ]);
        RelationType::create([
            'name' => '息子',
        ]);
        RelationType::create([
            'name' => '義理の息子',
        ]);
        RelationType::create([
            'name' => '娘',
        ]);
        RelationType::create([
            'name' => '義理の娘',
        ]);
        RelationType::create([
            'name' => '父親',
        ]);
        RelationType::create([
            'name' => '義父',
        ]);
        RelationType::create([
            'name' => '母親',
        ]);
        RelationType::create([
            'name' => '義母',
        ]);
        RelationType::create([
            'name' => '孫息子',
        ]);
        RelationType::create([
            'name' => '孫娘',
        ]);
        RelationType::create([
            'name' => '祖父',
        ]);
        RelationType::create([
            'name' => '祖母',
        ]);
        RelationType::create([
            'name' => '親戚',
        ]);
        RelationType::create([
            'name' => '知人',
        ]);
        RelationType::create([
            'name' => 'その他',
        ]);
    }
}
