<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ClientAdvertisement;

final class MasterClientAdvertisementService
{

    public function activate(
        ClientAdvertisement $advertisement,
        int $userId,
        ?float $price = null
    ): void {
        $advertisement->clientAdvertisementMasters()->firstOrCreate([
            'user_id' => $userId,
            'price'   => $price,
        ]);
    }

}