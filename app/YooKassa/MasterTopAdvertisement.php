<?php

declare(strict_types=1);

namespace App\YooKassa;

use App\Repositories\AdvertisementTopTariffRepository;
use App\Repositories\MasterAdvertisementRepository;
use App\Repositories\UserRepository;
use App\Services\AdvertisementTopTariffService;

final class MasterTopAdvertisement extends BaseYooKassaHandler
{

    public function execute(): void
    {
        $userRepository
            = app(UserRepository::class);

        $user = $userRepository->getById(
            (int) $this->payment->metadata->user_id
        );

        $tariff = app(AdvertisementTopTariffRepository::class)
            ->getById(
                (int) $this->payment->metadata->tariff_id
            );

        $masterAdvertisement = app(MasterAdvertisementRepository::class)
            ->getById((int) $this->payment->metadata->advertisement_id);

        if ($user === null || $tariff === null
            || $masterAdvertisement === null
        ) {
            return;
        }
        // TODO возможно стоит проверить является ли покупатель автором уведомления

        app(AdvertisementTopTariffService::class)
            ->setTariff($masterAdvertisement, $tariff);
    }

}