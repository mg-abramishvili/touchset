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
                'sort' => '999',
            ],
            [
                'id' => '2',
                'name' => 'Технология',
                'slug' => 'tekhnologia',
                'sort' => '999',
            ],
            [
                'id' => '3',
                'name' => 'Диагональ',
                'slug' => 'diagonal',
                'sort' => '999',
            ],
            [
                'id' => '4',
                'name' => 'Технология сенсорного экрана',
                'slug' => 'tekhnologiya_sensornogo_ekrana',
                'sort' => '999',
            ],
            [
                'id' => '5',
                'name' => 'Тип матрицы',
                'slug' => 'tip_matritsy',
                'sort' => '999',
            ],
            [
                'id' => '6',
                'name' => 'Видимая область',
                'slug' => 'vidimaya_oblast',
                'sort' => '999',
            ],
            [
                'id' => '7',
                'name' => 'Время отклика, мс',
                'slug' => 'vremya_otklika',
                'sort' => '999',
            ],
            [
                'id' => '8',
                'name' => 'Яркость',
                'slug' => 'yarkost',
                'sort' => '999',
            ],
            [
                'id' => '9',
                'name' => 'Контрастность',
                'slug' => 'kontrastnost',
                'sort' => '999',
            ],
            [
                'id' => '10',
                'name' => 'Углы обзора',
                'slug' => 'ugly_obzora',
                'sort' => '999',
            ],
            [
                'id' => '11',
                'name' => 'Разрешение',
                'slug' => 'razreshenie',
                'sort' => '999',
            ],
            [
                'id' => '12',
                'name' => 'Соотношение сторон',
                'slug' => 'sootnoshenie_storon',
                'sort' => '999',
            ],
            [
                'id' => '13',
                'name' => 'Интерфейсы и разъемы',
                'slug' => 'interfeysy_i_raziyemy',
                'sort' => '999',
            ],
            [
                'id' => '14',
                'name' => 'Стандарт VESA',
                'slug' => 'standart_vesa',
                'sort' => '999',
            ],
            [
                'id' => '15',
                'name' => 'Комплект поставки',
                'slug' => 'komplekt_postavki',
                'sort' => '999',
            ],
            [
                'id' => '16',
                'name' => 'Источник питания',
                'slug' => 'istochnik_pitaniya',
                'sort' => '999',
            ],
            [
                'id' => '17',
                'name' => 'Блок питания',
                'slug' => 'blok_pitaniya',
                'sort' => '999',
            ],
            [
                'id' => '18',
                'name' => 'Размеры (ШхВхГ)',
                'slug' => 'razmery',
                'sort' => '999',
            ],
            [
                'id' => '19',
                'name' => 'Вес',
                'slug' => 'ves',
                'sort' => '999',
            ],
            [
                'id' => '20',
                'name' => 'Звуковые колонки',
                'slug' => 'zvukovye_kolonky',
                'sort' => '999',
            ],
            [
                'id' => '21',
                'name' => 'Гарантия',
                'slug' => 'garantiya',
                'sort' => '999',
            ],
            [
                'id' => '22',
                'name' => 'Ориентация',
                'slug' => 'orientaciya',
                'sort' => '999',
            ],
            [
                'id' => '23',
                'name' => 'Размеры (ШхВхГ) с упаковкой',
                'slug' => 'razmery_s_upakovkoy',
                'sort' => '999',
            ],
            [
                'id' => '24',
                'name' => 'Вес (кг) с упаковкой',
                'slug' => 'ves_s_upakovkoy',
                'sort' => '999',
            ],
            [
                'id' => '25',
                'name' => 'Время работы',
                'slug' => 'vremya_raboty',
                'sort' => '999',
            ],
            [
                'id' => '26',
                'name' => 'Внешние габариты, мм',
                'slug' => 'vneshniye_gabarity',
                'sort' => '999',
            ],
            [
                'id' => '27',
                'name' => 'Активная область, мм',
                'slug' => 'aktivnaya_oblast',
                'sort' => '999',
            ],
            [
                'id' => '28',
                'name' => 'Метод ввода',
                'slug' => 'metod_vvoda',
                'sort' => '999',
            ],
            [
                'id' => '29',
                'name' => 'Количество точек касания',
                'slug' => 'kolichestvo_tochek_kasaniya',
                'sort' => '999',
            ],
            [
                'id' => '30',
                'name' => 'Точность позиционирования, мм',
                'slug' => 'tochnost_pozitsionirovaniya',
                'sort' => '999',
            ],
            [
                'id' => '31',
                'name' => 'Рабочая температура',
                'slug' => 'rabochaya_temperatura',
                'sort' => '999',
            ],
            [
                'id' => '32',
                'name' => 'Температура хранения',
                'slug' => 'temperatura_khraneniya',
                'sort' => '999',
            ],
            [
                'id' => '33',
                'name' => 'Поддержка',
                'slug' => 'podderzhka',
                'sort' => '999',
            ],
            [
                'id' => '34',
                'name' => 'Область применения',
                'slug' => 'oblast_primeneniya',
                'sort' => '999',
            ],
            [
                'id' => '35',
                'name' => 'Частота сканирования',
                'slug' => 'chastota_skanirovaniya',
                'sort' => '999',
            ],
            [
                'id' => '36',
                'name' => 'Сертификаты и стандарты',
                'slug' => 'sertifikaty_i_standarty',
                'sort' => '999',
            ],
        ]);
    }
}