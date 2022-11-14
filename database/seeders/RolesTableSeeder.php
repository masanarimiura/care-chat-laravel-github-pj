<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'name' => '医師',
        ]);
        Role::create([
            'name' => '看護師',
        ]);
        Role::create([
            'name' => '介護士',
        ]);
        Role::create([
            'name' => '薬剤師',
        ]);
        Role::create([
            'name' => '栄養士',
        ]);
        Role::create([
            'name' => '理学療法士',
        ]);
        Role::create([
            'name' => '作業療法士',
        ]);
        Role::create([
            'name' => '言語聴覚士',
        ]);
        Role::create([
            'name' => 'ケアマネージャー',
        ]);
        Role::create([
            'name' => '支援相談員',
        ]);
        Role::create([
            'name' => '施設担当者',
        ]);
    }
}
