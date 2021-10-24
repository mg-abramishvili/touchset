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
                'name' => 'Тип монитора',
                'slug' => 'tip_monitora',
            ],
            [
                'id' => '2',
                'name' => 'Технология',
                'slug' => 'tekhnologia',
            ],
            [
                'id' => '3',
                'name' => 'Диагональ',
                'slug' => 'diagonal',
            ],
            [
                'id' => '4',
                'name' => 'Технология сенсорного экрана',
                'slug' => 'tekhnologiya_sensornogo_ekrana',
            ],
            [
                'id' => '5',
                'name' => 'Тип матрицы',
                'slug' => 'tip_matritsy',
            ],
            [
                'id' => '6',
                'name' => 'Видимая область',
                'slug' => 'vidimaya_oblast',
            ],
            [
                'id' => '7',
                'name' => 'Время отклика, мс',
                'slug' => 'vremya_otklika',
            ],
            [
                'id' => '8',
                'name' => 'Яркость',
                'slug' => 'yarkost',
            ],
            [
                'id' => '9',
                'name' => 'Контрастность',
                'slug' => 'kontrastnost',
            ],
            [
                'id' => '10',
                'name' => 'Углы обзора',
                'slug' => 'ugly_obzora',
            ],
            [
                'id' => '11',
                'name' => 'Разрешение',
                'slug' => 'razreshenie',
            ],
            [
                'id' => '12',
                'name' => 'Соотношение сторон',
                'slug' => 'sootnoshenie_storon',
            ],
            [
                'id' => '13',
                'name' => 'Интерфейсы и разъемы',
                'slug' => 'interfeysy_i_raziyemy',
            ],
            [
                'id' => '14',
                'name' => 'Стандарт VESA',
                'slug' => 'standart_vesa',
            ],
            [
                'id' => '15',
                'name' => 'Комплект поставки',
                'slug' => 'komplekt_postavki',
            ],
            [
                'id' => '16',
                'name' => 'Источник питания',
                'slug' => 'istochnik_pitaniya',
            ],
            [
                'id' => '17',
                'name' => 'Блок питания',
                'slug' => 'blok_pitaniya',
            ],
            [
                'id' => '18',
                'name' => 'Размеры (ШхВхГ)',
                'slug' => 'razmery',
            ],
            [
                'id' => '19',
                'name' => 'Вес',
                'slug' => 'ves',
            ],
            [
                'id' => '20',
                'name' => 'Звуковые колонки',
                'slug' => 'zvukovye_kolonky',
            ],
            [
                'id' => '21',
                'name' => 'Гарантия',
                'slug' => 'garantiya',
            ],
            [
                'id' => '22',
                'name' => 'Ориентация',
                'slug' => 'orientaciya',
            ],
            [
                'id' => '23',
                'name' => 'Размеры (ШхВхГ) с упаковкой',
                'slug' => 'razmery_s_upakovkoy',
            ],
            [
                'id' => '24',
                'name' => 'Вес (кг) с упаковкой',
                'slug' => 'ves_s_upakovkoy',
            ],
            [
                'id' => '25',
                'name' => 'Время работы',
                'slug' => 'vremya_raboty',
            ],
        ]);
    }
}