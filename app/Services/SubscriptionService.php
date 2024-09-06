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

    public function getFreeAdvertisementPublishDays(User $user): int
    {
        return config('domain.free_published_days');
    }

    /** Тут проверяем подписку клиента! Может ли он создавать объявления! */
    public function checkCanCreateAdvertisement(User $user): bool
    {
        $activeMasterAdvertisements = $user
            ->masterAdvertisements()
            ->active()
            ->count();

        $maxAdvertisementCount = $this->getMaxAdvertisementCount($user);

        return $activeMasterAdvertisements < $maxAdvertisementCount;
    }

    public function isFreeAdvertisement(User $user): bool
    {
        $activeMasterAdvertisements = $user
            ->masterAdvertisements()
            ->active()
            ->count();

        return $activeMasterAdvertisements
            < $this->getFreeAdvertisementCount($user);
    }

    public function getMaxAdvertisementCount($user): int
    {
        $userSubscription = $user->subscription;

        $subscriptionAdvertisementCount
            = $userSubscription?->advertisement_count ?? 0;

        return $this->getFreeAdvertisementCount($user)
            + $subscriptionAdvertisementCount;
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

    /** Отписываем пользователя */
    public function unsubscribe(User $user): void
    {
        $user->update([
            'subscription_id'       => null,
            'subscription_start_at' => null,
            'subscription_end_at'   => null,
        ]);
    }

}