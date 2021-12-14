<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AddonSeeder extends Seeder
{
    public function run()
    {
        DB::table('addons')->insert([
            [
                'id' => '1',
                'name' => 'Индивидуальный дизайн',
                'slug' => 'ind_diz',
                'order' => '999',
            ],
            [
                'id' => '2',
                'name' => 'Наполнение',
                'slug' => 'napolnenie',
                'order' => '999',
            ],
        ]);
    }
}