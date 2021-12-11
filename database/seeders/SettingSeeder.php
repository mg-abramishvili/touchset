<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->insert([
            [
                'id' => '1',
                'tel' => '8 800 302 69 89',
                'email' => 'info@touchset.ru',
                'email_for_orders' => 'info@touchset.ru',
                'address' => 'г. Санкт-Петербург, шоссе Революции, дом 69',
                'schedule' => 'Пн-Пт 10:00-18:00'
            ],
        ]);
    }
}