<?php

declare(strict_types=1);

namespace App\YooKassa;

use App\Repositories\ClientAdvertisementRepository;

final class MasterPaymentClientAdvertisement extends BaseYooKassaHandler
{

    public function execute(): void
    {
        $clientAdvertisementRepository
            = app(ClientAdvertisementRepository::class);

        $advertisement
            = $clientAdvertisementRepository->getById((int) $this->payment->metadata->advertisement_id);

        if ($advertisement === null) {
            return;
        }

        $advertisement->clientAdvertisementMasters()->firstOrCreate([
            'user_id' => $this->payment->metadata->master_id,
            'price'   => config('yookassa.master-client-advertisement'),
        ]);
    }

}