<?php

declare(strict_types=1);

namespace App\YooKassa;

use App\Repositories\ClientAdvertisementRepository;
use App\Services\MasterClientAdvertisementService;

final class MasterPaymentClientAdvertisement extends BaseYooKassaHandler
{

    public function execute(): void
    {
        $clientAdvertisementRepository
            = app(ClientAdvertisementRepository::class);

        $masterClientAdvertisementService
            = app(MasterClientAdvertisementService::class);

        /** @var \App\Models\ClientAdvertisement|null $advertisement */
        $advertisement
            = $clientAdvertisementRepository->getById((int) $this->payment->metadata->advertisement_id);

        if ($advertisement === null) {
            return;
        }

        $masterClientAdvertisementService->activate(
            $advertisement,
            (int) $this->payment->metadata->master_id,
            (float) config('yookassa.master-client-advertisement')
        );
    }

}