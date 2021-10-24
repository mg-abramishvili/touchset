<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => '1',
                'name' => 'Мониторы',
                'slug' => 'monitory',
                'parent_id' => NULL,
            ],
            [
                'id' => '2',
                'name' => 'Рамки',
                'slug' => 'ramki',
                'parent_id' => NULL,
            ],
            [
                'id' => '3',
                'name' => 'Стекла',
                'slug' => 'stekla',
                'parent_id' => NULL,
            ],
            [
                'id' => '4',
                'name' => 'Пленки',
                'slug' => 'plenki',
                'parent_id' => NULL,
            ],
            [
                'id' => '5',
                'name' => 'Настенные мониторы',
                'slug' => 'nastenniye_monitory',
                'parent_id' => 1,
            ],
            [
                'id' => '6',
                'name' => 'Встраиваемые мониторы',
                'slug' => 'vstraivaemiye_monitory',
                'parent_id' => 1,
            ],
        ]);
    }
}