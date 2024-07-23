<?php

declare(strict_types=1);

namespace App\YooKassa;

use App\Repositories\SubscriptionRepository;
use App\Repositories\UserRepository;
use App\Services\SubscriptionService;

final class MasterSubscriptionAdvertisement extends BaseYooKassaHandler
{

    public function execute(): void
    {
        $userRepository
            = app(UserRepository::class);

        $user = $userRepository->getById(
            (int) $this->payment->metadata->user_id
        );

        $subscription = app(SubscriptionRepository::class)
            ->getById(
                (int) $this->payment->metadata->subscription_id
            );

        if ($user === null || $subscription === null) {
            return;
        }

        app(SubscriptionService::class)
            ->subscribe($user, $subscription);
    }

}