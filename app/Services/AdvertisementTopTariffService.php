<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\AdvertisementTopTariff;
use App\Models\MasterAdvertisement;

final class AdvertisementTopTariffService
{

    public function setTariff(
        MasterAdvertisement $masterAdvertisement,
        AdvertisementTopTariff $tariff
    ): void {
        $masterAdvertisement->update([
            'advertisement_top_tariff_id' => $tariff->id,
            'set_top_tariff_at'           => now(),
        ]);
    }

}