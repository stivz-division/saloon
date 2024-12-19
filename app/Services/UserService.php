<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Models\ViewSubscription;

final class UserService
{

    public function masterPaymentSubscribe(
        User $master,
        ViewSubscription $subscription
    ): void {
        if ($subscription->views_count === null) {
            $master->infoMaster()->update([
                'view_subscription_id' => $subscription->id,
                'is_subscription'      => true,
                'subscription_at'      => now(),
                'subscription_end_at'  => now()->addDays($subscription->viewing_days),
            ]);
        }

        if ($subscription->views_count !== null) {
            $master->infoMaster()->update([
                'view_subscription_id' => $subscription->id,
                'is_subscription'      => true,
                'subscription_at'      => null,
                'subscription_end_at'  => null,
                'subscription_views'   => $subscription->views_count,
            ]);
        }
    }

}