<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Subscription;
use App\Models\User;

final class SubscriptionService
{

    public function getFreeAdvertisementCount(User $user): int
    {
        return config('domain.free_advertisements');
    }

    /** Тут проверяем подписку клиента! Может ли он создавать объявления! */
    public function checkCanCreateAdvertisement(User $user): bool
    {
        $activeMasterAdvertisements = $user
            ->masterAdvertisements()
            ->active()
            ->count();

        $userSubscription = $user->subscription;

        $subscriptionAdvertisementCount
            = $userSubscription?->advertisement_count ?? 0;

        $maxAdvertisementCount = $this->getFreeAdvertisementCount($user)
            + $subscriptionAdvertisementCount;

        return $activeMasterAdvertisements < $maxAdvertisementCount;
    }

    /** Устанавливаем подписку пользователю */
    public function subscribe(User $user, Subscription $subscription): void
    {
        $user->update([
            'subscription_id'       => $subscription->id,
            'subscription_start_at' => now(),
            'subscription_end_at'   => now()->addMonth(),
        ]);
    }

}