<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::insert([
            ['id' => 1, 'id_parent' => 0, 'name' => 'Электроника'],
            ['id' => 2, 'id_parent' => 0, 'name' => 'Одежда'],
            ['id' => 3, 'id_parent' => 0, 'name' => 'Бытовая техника'],
            ['id' => 4, 'id_parent' => 1, 'name' => 'Телефоны и смарт-часы'],
            ['id' => 5, 'id_parent' => 1, 'name' => 'Компьютеры и комплектующие'],
            ['id' => 6, 'id_parent' => 2, 'name' => 'Женщинам'],
            ['id' => 7, 'id_parent' => 2, 'name' => 'Мужчинам'],
            ['id' => 9, 'id_parent' => 3, 'name' => 'Крупная бытовая техника'],
            ['id' => 10, 'id_parent' => 3, 'name' => 'Встраиваемая бытовая техника'],
            ['id' => 11, 'id_parent' => 4, 'name' => 'Смартфоны'],
            ['id' => 12, 'id_parent' => 4, 'name' => 'Смарт-часы и фитнес-браслеты'],
            ['id' => 13, 'id_parent' => 5, 'name' => 'Комплектующие для ПК'],
            ['id' => 14, 'id_parent' => 5, 'name' => 'Моноблоки'],
            ['id' => 15, 'id_parent' => 5, 'name' => 'Системные блоки'],
            ['id' => 16, 'id_parent' => 6, 'name' => 'Блузы и рубашки'],
            ['id' => 17, 'id_parent' => 7, 'name' => 'Брюки'],
            ['id' => 18, 'id_parent' => 7, 'name' => 'Верхняя одежда'],
            ['id' => 19, 'id_parent' => 9, 'name' => 'Холодильники'],
            ['id' => 20, 'id_parent' => 9, 'name' => 'Морозильные камеры'],
            ['id' => 21, 'id_parent' => 10, 'name' => 'Стиральные машины'],
            ['id' => 22, 'id_parent' => 10, 'name' => 'Сушильные машины'],
            ['id' => 23, 'id_parent' => 10, 'name' => 'Посудомойки'],
            ['id' => 24, 'id_parent' => 12, 'name' => 'Смарт-часы'],
            ['id' => 25, 'id_parent' => 12, 'name' => 'Фитнес-браслеты'],
            ['id' => 26, 'id_parent' => 12, 'name' => 'Браслеты и кольца бесконтактной оплаты'],
            ['id' => 27, 'id_parent' => 13, 'name' => 'Жесткие диски, SSD и сетевые накопители'],
            ['id' => 28, 'id_parent' => 13, 'name' => 'Видеокарты и графические ускорители'],
            ['id' => 29, 'id_parent' => 13, 'name' => 'Оперативная память'],
            ['id' => 30, 'id_parent' => 13, 'name' => 'Материнские платы'],
            ['id' => 31, 'id_parent' => 13, 'name' => 'Процессоры'],
            ['id' => 32, 'id_parent' => 16, 'name' => 'Блузы'],
            ['id' => 33, 'id_parent' => 16, 'name' => 'Рубашки'],
        ]);
    }
}
