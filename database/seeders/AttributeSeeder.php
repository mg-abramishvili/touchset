<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        DB::table('attributes')->insert([
            [
                'id' => '1',
                'name' => 'Разрешение',
                'slug' => 'resolution',
                'order' => '999',
            ],
            [
                'id' => '2',
                'name' => 'Мин. требования',
                'slug' => 'requirements',
                'order' => '999',
            ],
            [
                'id' => '3',
                'name' => 'Тип поставки',
                'slug' => 'supply_type',
                'order' => '999',
            ],
            [
                'id' => '4',
                'name' => 'Срок поставки',
                'slug' => 'supply_time',
                'order' => '999',
            ],
        ]);
    }
}