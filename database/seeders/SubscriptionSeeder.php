<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::query()->create([
            'name'                => '1 БИЧ ПАКЕТ',
            'advertisement_count' => 1,
            'published_days'      => 7,
            'price'               => 100,
            'status'              => true,
        ]);

        Subscription::query()->create([
            'name'                => '1 БИЧ ПАКЕТ +',
            'advertisement_count' => 1,
            'published_days'      => 30,
            'price'               => 200,
            'status'              => true,
        ]);

        Subscription::query()->create([
            'name'                => '1 БИЧ ПАКЕТ Pro',
            'advertisement_count' => 1,
            'published_days'      => 90,
            'price'               => 300,
            'status'              => true,
        ]);

        Subscription::query()->create([
            'name'                => '1 БИЧ ПАКЕТ Pro +',
            'advertisement_count' => 1,
            'published_days'      => 182,
            'price'               => 500,
            'status'              => true,
        ]);

        Subscription::query()->create([
            'name'                => '1 БИЧ ПАКЕТ Pro Max +',
            'advertisement_count' => 1,
            'published_days'      => 365,
            'price'               => 800,
            'status'              => true,
        ]);
    }

}
