<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\MasterSubscribeHistory;
use App\Models\User;

final class MasterSubscribeHistoryService
{

    /**
     * @param  \App\Models\User  $master
     * @param  float|null  $price
     *
     * @return \App\Models\MasterSubscribeHistory
     */
    public function store(
        User $master,
        ?float $price = null
    ): MasterSubscribeHistory {
        return MasterSubscribeHistory::query()->create([
            'user_id' => $master->id,
            'price'   => $price,
        ]);
    }

}