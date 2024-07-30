<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\AdvertisementTopTariff;
use Illuminate\Database\Eloquent\Collection;

final class AdvertisementTopTariffRepository
{

    public function list(): Collection
    {
        return AdvertisementTopTariff::query()
            ->where('status', true)
            ->get();
    }

    public function getById(int $id): ?AdvertisementTopTariff
    {
        return AdvertisementTopTariff::query()
            ->where('status', true)
            ->find($id);
    }

}