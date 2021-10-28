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
                'name' => 'Школы и ВУЗы',
                'slug' => 'shkoly_i_vuzy',
                'image' => '/img/globe1.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '2',
                'name' => 'Музеи',
                'slug' => 'muzei',
                'image' => '/img/museum.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '3',
                'name' => 'Торговые центры',
                'slug' => 'torgoviye_tsentry',
                'image' => '/img/shopping2.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '4',
                'name' => 'Детские сады',
                'slug' => 'detskiye_sady',
                'image' => '/img/teddy.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '5',
                'name' => 'Мед. центры',
                'slug' => 'medtsentry',
                'image' => '/img/med2.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '6',
                'name' => 'Банки',
                'slug' => 'banki',
                'image' => '/img/safe.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '7',
                'name' => 'Заводы и предприятия',
                'slug' => 'zavody_i_predpriyatiya',
                'image' => '/img/zavod.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '8',
                'name' => 'Храмы, мечети и синагоги',
                'slug' => 'khramy_mechety_i_sinagogi',
                'image' => '/img/religion.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '9',
                'name' => 'Парки',
                'slug' => 'parki',
                'image' => '/img/park.png',
                'parent_id' => NULL,
            ],
        ]);
    }
}