<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ViewSubscription;
use Illuminate\Database\Eloquent\Collection;

final class VIewSubscriptionRepository
{

    public function tarrifs(): Collection
    {
        return ViewSubscription::query()
            ->where('status', true)
            ->get();
    }

    /**
     * @param  int  $id
     *
     * @return \App\Models\ViewSubscription
     */
    public function getById(int $id): ViewSubscription
    {
        return ViewSubscription::query()
            ->where('id', $id)
            ->first();
    }

}