<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Collection;

final class SubscriptionRepository
{

    public function list(): Collection
    {
        return Subscription::query()
            ->where('status', true)
            ->get();
    }

    public function getById(int $id): ?Subscription
    {
        return Subscription::query()->find($id);
    }

}