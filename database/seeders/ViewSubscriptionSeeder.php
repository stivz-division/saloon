<?php

namespace Database\Seeders;

use App\Models\ViewSubscription;
use Illuminate\Database\Seeder;

class ViewSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Поштучно, без ограничения по времени
        ViewSubscription::query()->create([
            'name' => '1 объявление',
            'views_count' => 1,
            'viewing_days' => 99999,
            'price' => 50,
            'status' => true,
        ]);

        ViewSubscription::query()->create([
            'name' => '10 объявлений',
            'views_count' => 10,
            'viewing_days' => 99999,
            'price' => 400,
            'status' => true,
        ]);

        ViewSubscription::query()->create([
            'name' => '100 объявлений',
            'views_count' => 100,
            'viewing_days' => 99999,
            'price' => 3000,
            'status' => true,
        ]);

        ViewSubscription::query()->create([
            'name' => '1000 объявлений',
            'views_count' => 1000,
            'viewing_days' => 99999,
            'price' => 20000,
            'status' => true,
        ]);

        ViewSubscription::query()->create([
            'name' => '10000 объявлений',
            'views_count' => 10000,
            'viewing_days' => 99999,
            'price' => 100000,
            'status' => true,
        ]);

        // Срочный безлимит
        ViewSubscription::query()->create([
            'name' => '1 день',
            'views_count' => null,
            'viewing_days' => 1,
            'price' => 500,
            'status' => true,
        ]);

        ViewSubscription::query()->create([
            'name' => '1 неделя',
            'views_count' => null,
            'viewing_days' => 7,
            'price' => 1500,
            'status' => true,
        ]);

        ViewSubscription::query()->create([
            'name' => '1 месяц',
            'views_count' => null,
            'viewing_days' => 30,
            'price' => 3000,
            'status' => true,
        ]);

        ViewSubscription::query()->create([
            'name' => '3 месяца',
            'views_count' => null,
            'viewing_days' => 90,
            'price' => 6000,
            'status' => true,
        ]);

        ViewSubscription::query()->create([
            'name' => '6 месяца',
            'views_count' => null,
            'viewing_days' => 180,
            'price' => 10000,
            'status' => true,
        ]);

        ViewSubscription::query()->create([
            'name' => '12 месяцев',
            'views_count' => null,
            'viewing_days' => 365,
            'price' => 15000,
            'status' => true,
        ]);
    }
}
