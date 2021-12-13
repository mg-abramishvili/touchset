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
                'cover' => '/img/globe1.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '2',
                'name' => 'Музеи',
                'slug' => 'muzei',
                'cover' => '/img/museum.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '3',
                'name' => 'Торговые центры',
                'slug' => 'torgoviye_tsentry',
                'cover' => '/img/shopping2.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '4',
                'name' => 'Детские сады',
                'slug' => 'detskiye_sady',
                'cover' => '/img/teddy.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '5',
                'name' => 'Мед. центры',
                'slug' => 'medtsentry',
                'cover' => '/img/med2.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '6',
                'name' => 'Банки',
                'slug' => 'banki',
                'cover' => '/img/safe.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '7',
                'name' => 'Заводы и предприятия',
                'slug' => 'zavody_i_predpriyatiya',
                'cover' => '/img/zavod.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '8',
                'name' => 'Храмы, мечети и синагоги',
                'slug' => 'khramy_mechety_i_sinagogi',
                'cover' => '/img/religion.png',
                'parent_id' => NULL,
            ],
            [
                'id' => '9',
                'name' => 'Парки',
                'slug' => 'parki',
                'cover' => '/img/park.png',
                'parent_id' => NULL,
            ],
        ]);
    }
}