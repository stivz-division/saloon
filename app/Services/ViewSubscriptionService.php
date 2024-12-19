<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ClientAdvertisement;
use App\Models\User;

final class ViewSubscriptionService
{

    public function handlerClientAdvertisement(
        User $user,
        ClientAdvertisement $advertisement
    ): void {
        if ($user->isMaster() === false) {
            return;
        }

        $info = $user->infoMaster;

        if ($info->is_subscription === false) {
            return;
        }

        $viewSubscription = $info->viewSubscription;

        if ($viewSubscription->views_count === null) {
            if ($info->subscription_end_at->isPast()) {
                $info->update([
                    'view_subscription_id' => null,
                    'is_subscription'      => false,
                    'subscription_at'      => null,
                    'subscription_end_at'  => null,
                    'subscription_views'   => null,
                ]);

                return;
            }
        }

        if ($viewSubscription->views_count !== null) {
            if ($info->subscription_views <= 0) {
                $info->update([
                    'view_subscription_id' => null,
                    'is_subscription'      => false,
                    'subscription_at'      => null,
                    'subscription_end_at'  => null,
                    'subscription_views'   => null,
                ]);

                return;
            }

            $info->update([
                'subscription_views' => $info->subscription_views - 1,
            ]);
        }

        $advertisement->clientAdvertisementMasters()->firstOrCreate([
            'user_id' => $user->id,
            'price'   => $viewSubscription->price,
        ]);
    }

}