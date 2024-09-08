<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class SubscriptionRepository
{

    public function list(): Collection
    {
        return Subscription::query()
            ->with([
                'stock' => function (HasOne $query) {
                    $query->where('start_at', '<=', now());
                },
            ])
            ->where('status', true)
            ->get();
    }

    public function getById(int $id): ?Subscription
    {
        return Subscription::query()->find($id);
    }

}