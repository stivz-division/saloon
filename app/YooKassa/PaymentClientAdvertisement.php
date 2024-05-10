<?php

declare(strict_types=1);

namespace App\YooKassa;

use App\Services\ClientAdvertisementService;

final class PaymentClientAdvertisement extends BaseYooKassaHandler
{

    public function execute(): void
    {
        $clientAdvertisementService = app(ClientAdvertisementService::class);

        $clientAdvertisementId = (int) $this->payment->metadata->id;

        $clientAdvertisementService->payment(
            $clientAdvertisementId,
        );
    }

}