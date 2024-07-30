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
            'name'       => '1 день',
            'count_days' => 1,
            'type'       => AdvertisementTopTariffsType::Minute,
            'minutes'    => 60,
            'status'     => true,
            'price'      => 100,
        ]);

        AdvertisementTopTariff::query()->create([
            'name'       => '1 день PRO',
            'count_days' => 1,
            'type'       => AdvertisementTopTariffsType::Minute,
            'minutes'    => 15,
            'status'     => true,
            'price'      => 300,
        ]);

        AdvertisementTopTariff::query()->create([
            'name'       => '1 день PRO +',
            'count_days' => 1,
            'type'       => AdvertisementTopTariffsType::Minute,
            'minutes'    => 1,
            'status'     => true,
            'price'      => 1000,
        ]);

        AdvertisementTopTariff::query()->create([
            'name'       => '1 неделя',
            'count_days' => 7,
            'type'       => AdvertisementTopTariffsType::ConcreteTime,
            'start_time' => '00:00:00',
            'status'     => true,
            'price'      => 1000,
        ]);
    }

}
