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
                'image' => '/img/cat/tl-cmc-27-1.jpg',
                'parent_id' => NULL,
            ],
            [
                'id' => '2',
                'name' => 'Рамки',
                'slug' => 'ramki',
                'image' => '/img/cat/ramka-sensornaya1.jpg',
                'parent_id' => NULL,
            ],
            [
                'id' => '3',
                'name' => 'Стекла',
                'slug' => 'stekla',
                'image' => NULL,
                'parent_id' => NULL,
            ],
            [
                'id' => '4',
                'name' => 'Пленки',
                'slug' => 'plenki',
                'image' => NULL,
                'parent_id' => NULL,
            ],
            [
                'id' => '5',
                'name' => 'Настенные мониторы',
                'slug' => 'nastenniye_monitory',
                'image' => '/img/cat/sensornyj-monitor-tl-cmm-55.jpg',
                'parent_id' => 1,
            ],
            [
                'id' => '6',
                'name' => 'Встраиваемые мониторы',
                'slug' => 'vstraivaemiye_monitory',
                'image' => '/img/cat/tl-cmc-27-1.jpg',
                'parent_id' => 1,
            ],
        ]);
    }
}