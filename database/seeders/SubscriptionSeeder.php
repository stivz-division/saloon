<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * Подписки для Мастера
     */
    public function run(): void
    {
        // 1 объявление
        Subscription::query()->create([
            'name' => '1 объявление на неделю',
            'advertisement_count' => 1,
            'published_days' => 7,
            'price' => 100,
            'status' => true,
        ]);

        Subscription::query()->create([
            'name' => '1 объявление на 30 дней',
            'advertisement_count' => 1,
            'published_days' => 30,
            'price' => 200,
            'status' => true,
        ]);

        Subscription::query()->create([
            'name' => '1 объявление на 90 дней',
            'advertisement_count' => 1,
            'published_days' => 90,
            'price' => 300,
            'status' => true,
        ]);

        Subscription::query()->create([
            'name' => '1 объявление на пол года',
            'advertisement_count' => 1,
            'published_days' => 182,
            'price' => 500,
            'status' => true,
        ]);

        Subscription::query()->create([
            'name' => 'Объявление на год',
            'advertisement_count' => 1,
            'published_days' => 365,
            'price' => 800,
            'status' => true,
        ]);

        // 10-20 объявлений
        Subscription::query()->create([
            'name' => '10 объявлений на 30 дней',
            'advertisement_count' => 1,
            'published_days' => 30,
            'price' => 500,
            'status' => true,
        ]);

        Subscription::query()->create([
            'name' => '10 объявлений на 90 дней',
            'advertisement_count' => 1,
            'published_days' => 90,
            'price' => 1200,
            'status' => true,
        ]);

        Subscription::query()->create([
            'name' => '10 объявлений на пол года',
            'advertisement_count' => 1,
            'published_days' => 182,
            'price' => 2200,
            'status' => true,
        ]);

        Subscription::query()->create([
            'name' => '20 объявлений на год',
            'advertisement_count' => 1,
            'published_days' => 365,
            'price' => 4000,
            'status' => true,
        ]);

        // 100 объявлений
        Subscription::query()->create([
            'name' => '100 объявлений на 30 дней',
            'advertisement_count' => 1,
            'published_days' => 30,
            'price' => 3000,
            'status' => true,
        ]);

        Subscription::query()->create([
            'name' => '100 объявлений на 90 дней',
            'advertisement_count' => 1,
            'published_days' => 90,
            'price' => 8000,
            'status' => true,
        ]);

        Subscription::query()->create([
            'name' => '100 объявлений на пол года',
            'advertisement_count' => 1,
            'published_days' => 182,
            'price' => 15000,
            'status' => true,
        ]);

        Subscription::query()->create([
            'name' => '100 объявлений на год',
            'advertisement_count' => 1,
            'published_days' => 365,
            'price' => 25000,
            'status' => true,
        ]);
    }

}
