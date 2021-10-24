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
                'name' => 'Диагональ',
                'slug' => 'diagonal',
            ],
            [
                'id' => '2',
                'name' => 'Технология сенсорного экрана',
                'slug' => 'tekhnologiya_sensornogo_ekrana',
            ],
            [
                'id' => '3',
                'name' => 'Тип матрицы',
                'slug' => 'tip_matritsy',
            ],
            [
                'id' => '4',
                'name' => 'Видимая область',
                'slug' => 'vidimaya_oblast',
            ],
            [
                'id' => '5',
                'name' => 'Время отклика, мс',
                'slug' => 'vremya_otklika',
            ],
            [
                'id' => '6',
                'name' => 'Яркость',
                'slug' => 'yarkost',
            ],
            [
                'id' => '7',
                'name' => 'Контрастность',
                'slug' => 'kontrastnost',
            ],
            [
                'id' => '8',
                'name' => 'Углы обзора',
                'slug' => 'ugly_obzora',
            ],
            [
                'id' => '9',
                'name' => 'Разрешение',
                'slug' => 'razreshenie',
            ],
            [
                'id' => '10',
                'name' => 'Соотношение сторон',
                'slug' => 'sootnoshenie_storon',
            ],
            [
                'id' => '11',
                'name' => 'Интерфейсы и разъемы',
                'slug' => 'interfeysy_i_raziyemy',
            ],
            [
                'id' => '12',
                'name' => 'Стандарт VESA',
                'slug' => 'standart_vesa',
            ],
            [
                'id' => '13',
                'name' => 'Комплект поставки',
                'slug' => 'komplekt_postavki',
            ],
            [
                'id' => '14',
                'name' => 'Источник питания',
                'slug' => 'istochnik_pitaniya',
            ],
            [
                'id' => '15',
                'name' => 'Блок питания',
                'slug' => 'blok_pitaniya',
            ],
            [
                'id' => '16',
                'name' => 'Размеры (ШхВхГ)',
                'slug' => 'razmery',
            ],
            [
                'id' => '17',
                'name' => 'Вес',
                'slug' => 'ves',
            ],
            [
                'id' => '18',
                'name' => 'Звуковые колонки',
                'slug' => 'zvukovye_kolonky',
            ],
            [
                'id' => '19',
                'name' => 'Гарантия',
                'slug' => 'garantiya',
            ],
            [
                'id' => '20',
                'name' => 'Ориентация',
                'slug' => 'orientaciya',
            ],
            [
                'id' => '21',
                'name' => 'Размеры (ШхВхГ) с упаковкой',
                'slug' => 'razmery_s_upakovkoy',
            ],
            [
                'id' => '22',
                'name' => 'Вес (кг) с упаковкой',
                'slug' => 'ves_s_upakovkoy',
            ],
            [
                'id' => '23',
                'name' => 'Время работы',
                'slug' => 'vremya_raboty',
            ],
        ]);
    }
}