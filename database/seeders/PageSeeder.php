<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run()
    {
        DB::table('pages')->insert([
            [
                'id' => '1',
                'name' => 'Контакты',
                'slug' => 'contacts',
                'content' => '<p><strong>Электронная почта:</strong> info@tachlab.ru</p><p><strong>Офис:</strong> г. Санкт-Петербург, шоссе Революции, дом 69</p><p><strong>Телефон:</strong> 8(800)200-23-02</p><p><strong>Режим работы:</strong> Пн-Пт 10:00-18:00</p>'
            ],
        ]);
    }
}