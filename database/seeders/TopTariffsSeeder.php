<?php

namespace Database\Seeders;

use App\Domain\Enum\AdvertisementTopTariffsType;
use App\Models\AdvertisementTopTariff;
use Illuminate\Database\Seeder;

class TopTariffsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdvertisementTopTariff::query()->create([
            'name' => '1 день',
            'count_days' => 1,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 60,
            'status' => true,
            'price' => 100,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '1 день PRO',
            'count_days' => 1,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 15,
            'status' => true,
            'price' => 300,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '1 день PREMIUM',
            'count_days' => 1,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 1,
            'status' => true,
            'price' => 1000,
        ]);

        // Неделя
        AdvertisementTopTariff::query()->create([
            'name' => '1 неделя',
            'count_days' => 7,
            'type' => AdvertisementTopTariffsType::ConcreteTime,
            'start_time' => '00:00:00',
            'status' => true,
            'price' => 300,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '1 неделя каждые 6 часов',
            'count_days' => 7,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 360,
            'status' => true,
            'price' => 800,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '1 неделя PRO',
            'count_days' => 7,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 60,
            'status' => true,
            'price' => 1600,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '1 неделя PREMIUM',
            'count_days' => 7,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 15,
            'status' => true,
            'price' => 6000,
        ]);

        // Месяц
        AdvertisementTopTariff::query()->create([
            'name' => '1 месяц',
            'count_days' => 30,
            'type' => AdvertisementTopTariffsType::ConcreteTime,
            'start_time' => '00:00:00',
            'status' => true,
            'price' => 1000,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '1 месяц каждые 6 часов',
            'count_days' => 30,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 360,
            'status' => true,
            'price' => 3000,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '1 месяц PRO',
            'count_days' => 30,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 60,
            'status' => true,
            'price' => 6000,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '1 месяц PREMIUM',
            'count_days' => 30,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 15,
            'status' => true,
            'price' => 25000,
        ]);

        // 3 Месяца
        AdvertisementTopTariff::query()->create([
            'name' => '3 месяц',
            'count_days' => 91,
            'type' => AdvertisementTopTariffsType::ConcreteTime,
            'start_time' => '00:00:00',
            'status' => true,
            'price' => 2000,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '3 месяца каждые 6 часов',
            'count_days' => 91,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 360,
            'status' => true,
            'price' => 6000,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '3 месяца PRO',
            'count_days' => 91,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 60,
            'status' => true,
            'price' => 12000,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '3 месяца PREMIUM',
            'count_days' => 91,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 15,
            'status' => true,
            'price' => 50000,
        ]);

        // 6 Месяцев
        AdvertisementTopTariff::query()->create([
            'name' => 'Полгода',
            'count_days' => 183,
            'type' => AdvertisementTopTariffsType::ConcreteTime,
            'start_time' => '00:00:00',
            'status' => true,
            'price' => 4000,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => 'Полгода каждые 6 часов',
            'count_days' => 183,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 360,
            'status' => true,
            'price' => 12000,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '1 месяц PRO',
            'count_days' => 183,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 60,
            'status' => true,
            'price' => 24000,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '1 месяц PREMIUM',
            'count_days' => 183,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 15,
            'status' => true,
            'price' => 100000,
        ]);

        // Год
        AdvertisementTopTariff::query()->create([
            'name' => 'Полгода',
            'count_days' => 366,
            'type' => AdvertisementTopTariffsType::ConcreteTime,
            'start_time' => '00:00:00',
            'status' => true,
            'price' => 6000,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => 'Полгода каждые 6 часов',
            'count_days' => 366,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 360,
            'status' => true,
            'price' => 20000,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '1 месяц PRO',
            'count_days' => 366,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 60,
            'status' => true,
            'price' => 40000,
        ]);

        AdvertisementTopTariff::query()->create([
            'name' => '1 месяц PREMIUM',
            'count_days' => 366,
            'type' => AdvertisementTopTariffsType::Minute,
            'minutes' => 15,
            'status' => true,
            'price' => 180000,
        ]);
    }

}
