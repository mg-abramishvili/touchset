<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AttributeSeeder::class,
            CategorySeeder::class,
            PageSeeder::class,
            SettingSeeder::class,
        ]);
    }
}